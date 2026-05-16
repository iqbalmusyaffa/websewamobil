<?php

namespace App\Filament\Resources\BookingExtensions\Pages;

use App\Filament\Resources\BookingExtensions\BookingExtensionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBookingExtensions extends ListRecords
{
    protected static string $resource = BookingExtensionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
