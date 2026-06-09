<?php

namespace App\Filament\Resources\AirportTransferPrices\Pages;

use App\Filament\Resources\AirportTransferPrices\AirportTransferPriceResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAirportTransferPrice extends EditRecord
{
    protected static string $resource = AirportTransferPriceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
