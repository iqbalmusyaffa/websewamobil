<?php

namespace App\Filament\Resources\AirportZones\Pages;

use App\Filament\Resources\AirportZones\AirportZoneResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAirportZones extends ListRecords
{
    protected static string $resource = AirportZoneResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
