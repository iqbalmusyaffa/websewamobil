<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;

class AdminInvoiceController extends Controller
{
    public function download(Booking $booking)
    {
        // Require admin authentication
        if (!auth()->check()) {
            abort(403, 'Unauthorized');
        }

        $booking->load('car', 'user', 'addons', 'promoCode', 'carUnit');

        // Create PDF
        $html = View::make('invoice.pdf', compact('booking'))->render();
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $filename = 'Kwitansi-' . str_pad($booking->id, 5, '0', STR_PAD_LEFT) . '.pdf';
        
        return response($dompdf->output(), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="' . $filename . '"');
    }
}
