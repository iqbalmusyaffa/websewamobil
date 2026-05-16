<?php

namespace App\Listeners;

use App\Events\DocumentVerified;

class AwardPointsForDocumentVerification
{
    /**
     * Berikan poin ketika dokumen disetujui/diverifikasi admin.
     * Verifikasi dokumen pertama kali: +100 poin
     */
    public function handle(DocumentVerified $event): void
    {
        $document = $event->document;
        $user = $document->user;

        if (!$user) return;

        // Hanya beri poin jika status berubah menjadi 'disetujui' (dari status lain)
        if ($document->status === 'disetujui' && $event->previousStatus !== 'disetujui') {
            $user->addPoints(100, '✅ Dokumen identitas (KTP/SIM) berhasil diverifikasi admin');
        }
    }
}
