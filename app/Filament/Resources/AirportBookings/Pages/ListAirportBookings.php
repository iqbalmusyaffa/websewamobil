<?php

namespace App\Filament\Resources\AirportBookings\Pages;

use App\Filament\Resources\AirportBookings\AirportBookingResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAirportBookings extends ListRecords
{
    protected static string $resource = AirportBookingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
