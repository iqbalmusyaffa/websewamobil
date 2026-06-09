<?php

namespace App\Filament\Resources\AirportBookings\Pages;

use App\Filament\Resources\AirportBookings\AirportBookingResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAirportBooking extends EditRecord
{
    protected static string $resource = AirportBookingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
