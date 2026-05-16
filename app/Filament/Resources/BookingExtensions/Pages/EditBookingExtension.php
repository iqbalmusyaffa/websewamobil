<?php

namespace App\Filament\Resources\BookingExtensions\Pages;

use App\Filament\Resources\BookingExtensions\BookingExtensionResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditBookingExtension extends EditRecord
{
    protected static string $resource = BookingExtensionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
