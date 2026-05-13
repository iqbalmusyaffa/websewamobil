<?php

namespace App\Filament\Resources\Documents\Pages;

use App\Filament\Resources\Documents\DocumentResource;
use Filament\Resources\Pages\CreateRecord;

class CreateDocument extends CreateRecord
{
    protected static string $resource = DocumentResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Handle KTP link
        if (!empty($data['ktp_link'])) {
            $data['ktp_path'] = $data['ktp_link'];
        }
        unset($data['ktp_link']);

        // Handle SIM link
        if (!empty($data['sim_link'])) {
            $data['sim_path'] = $data['sim_link'];
        }
        unset($data['sim_link']);

        return $data;
    }
}
