<?php

namespace App\Filament\Resources\AirportTransferPrices\Pages;

use App\Filament\Resources\AirportTransferPrices\AirportTransferPriceResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAirportTransferPrices extends ListRecords
{
    protected static string $resource = AirportTransferPriceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
