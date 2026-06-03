<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class SecureDocumentController extends Controller
{
    /**
     * Tampilkan atau redirect ke dokumen (KTP/SIM) secara aman.
     */
    public function show(Document $document, $type)
    {
        // Otorisasi: hanya pemilik dokumen atau admin yang bisa akses
        $user = Auth::user();
        if ($document->user_id !== $user->id && $user->role !== 'admin') {
            abort(Response::HTTP_FORBIDDEN, 'Anda tidak memiliki akses ke dokumen ini.');
        }

        // Tentukan path berdasarkan tipe dokumen
        $path = null;
        if ($type === 'ktp') {
            $path = $document->ktp_path;
        } elseif ($type === 'sim') {
            $path = $document->sim_path;
        } else {
            abort(Response::HTTP_NOT_FOUND, 'Tipe dokumen tidak valid.');
        }

        if (empty($path)) {
            abort(Response::HTTP_NOT_FOUND, 'Dokumen belum diunggah.');
        }

        // Jika path berupa URL eksternal (misal: Google Drive), langsung redirect
        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return redirect()->away($path);
        }

        // Jika path berupa file lokal (tersimpan di storage/app)
        // Pastikan kita bisa membaca dari local disk (private by default)
        if (Storage::disk('local')->exists($path)) {
            return Storage::disk('local')->response($path);
        }
        
        // Cek fallback public disk jika datanya adalah data lama yang belum terenkripsi
        if (Storage::disk('public')->exists(str_replace('storage/', '', $path))) {
            return Storage::disk('public')->response(str_replace('storage/', '', $path));
        }

        abort(Response::HTTP_NOT_FOUND, 'File dokumen tidak ditemukan di server.');
    }
}
