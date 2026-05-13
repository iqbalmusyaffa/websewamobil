<?php

namespace App\Filament\Resources\Branches\Pages;

use App\Filament\Resources\Branches\BranchResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditBranch extends EditRecord
{
    protected static string $resource = BranchResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Handle cover image URL
        if (!empty($data['cover_image_url'])) {
            $data['cover_image'] = $data['cover_image_url'];
        }
        unset($data['cover_image_url']);

        // Handle gallery URLs
        if (!empty($data['gallery_urls'])) {
            $urls = array_filter(array_map('trim', explode("\n", $data['gallery_urls'])));
            if (!empty($urls)) {
                $data['gallery_images'] = $urls;
            }
        }
        unset($data['gallery_urls']);

        return $data;
    }
}
