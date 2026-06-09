<?php

namespace App\Filament\Resources\AirportTransferPrices\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class AirportTransferPriceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('airport_id')
                    ->relationship('airport', 'name')
                    ->required(),
                Select::make('airport_zone_id')
                    ->relationship('airportZone', 'name')
                    ->required(),
                Select::make('car_id')
                    ->relationship('car', 'name')
                    ->required(),
                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('Rp'),
            ]);
    }
}
