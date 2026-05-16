<?php

namespace App\Filament\Resources\BookingExtensions\Pages;

use App\Filament\Resources\BookingExtensions\BookingExtensionResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewBookingExtension extends ViewRecord
{
    protected static string $resource = BookingExtensionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
