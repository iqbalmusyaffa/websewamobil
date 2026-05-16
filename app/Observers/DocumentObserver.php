<?php

namespace App\Observers;

use App\Events\DocumentUploaded;
use App\Events\DocumentVerified;
use App\Models\Document;

class DocumentObserver
{
    /**
     * Dipanggil ketika dokumen baru pertama kali dibuat (user upload).
     * Dispatch event DocumentUploaded dengan isFirstUpload = true.
     */
    public function created(Document $document): void
    {
        DocumentUploaded::dispatch($document, true);
    }

    /**
     * Dipanggil setiap kali dokumen diupdate.
     * - Jika status berubah menjadi 'disetujui' → dispatch DocumentVerified
     * - Jika KTP/SIM path berubah (user update dokumen) → dispatch DocumentUploaded
     */
    public function updated(Document $document): void
    {
        $previousStatus = $document->getOriginal('status');

        // Dispatch verifikasi event jika status berubah ke 'disetujui'
        if ($document->isDirty('status') && $document->status === 'disetujui') {
            DocumentVerified::dispatch($document, $previousStatus);
        }

        // Dispatch upload event jika path KTP atau SIM diubah (bukan first upload, sudah ada sebelumnya)
        $ktpChanged = $document->isDirty('ktp_path') && $document->getOriginal('ktp_path') !== null;
        $simChanged = $document->isDirty('sim_path') && $document->getOriginal('sim_path') !== null;

        if ($ktpChanged || $simChanged) {
            DocumentUploaded::dispatch($document, false);
        }
    }
}
