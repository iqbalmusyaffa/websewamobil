<?php

namespace App\Filament\Resources\AirportZones\Pages;

use App\Filament\Resources\AirportZones\AirportZoneResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAirportZone extends EditRecord
{
    protected static string $resource = AirportZoneResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
