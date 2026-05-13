<?php

namespace App\Filament\Resources\Documents\Pages;

use App\Filament\Resources\Documents\DocumentResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDocument extends EditRecord
{
    protected static string $resource = DocumentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
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
