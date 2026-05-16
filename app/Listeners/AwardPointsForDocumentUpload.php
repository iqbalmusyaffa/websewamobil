<?php

namespace App\Listeners;

use App\Events\DocumentUploaded;

class AwardPointsForDocumentUpload
{
    /**
     * Berikan poin ketika user pertama kali upload dokumen KTP/SIM.
     * - Upload pertama KTP/SIM: +50 poin
     * - Update dokumen (bukan first upload): +10 poin
     */
    public function handle(DocumentUploaded $event): void
    {
        $document = $event->document;
        $user = $document->user;

        if (!$user) return;

        if ($event->isFirstUpload) {
            $user->addPoints(50, '🪪 Upload dokumen KTP/SIM pertama kali');
        } else {
            $user->addPoints(10, '🪪 Update data dokumen KTP/SIM');
        }
    }
}
