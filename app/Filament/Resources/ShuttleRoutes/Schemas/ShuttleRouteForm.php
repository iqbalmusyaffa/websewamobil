<?php

namespace App\Filament\Resources\ShuttleRoutes\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ShuttleRouteForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('origin_city')
                    ->required(),
                TextInput::make('destination_city')
                    ->required(),
                \Filament\Forms\Components\Select::make('class_type')
                    ->options([
                        'Ekonomi' => 'Ekonomi',
                        'Eksekutif' => 'Eksekutif',
                        'VIP' => 'VIP',
                        'Sleeper' => 'Sleeper',
                    ])
                    ->required()
                    ->default('Eksekutif'),
                TimePicker::make('departure_time')
                    ->required(),
                TimePicker::make('arrival_time')
                    ->required(),
                TextInput::make('base_price')
                    ->required()
                    ->numeric()
                    ->prefix('Rp'),
                TextInput::make('total_seats')
                    ->required()
                    ->numeric()
                    ->default(14),
                Toggle::make('is_active')
                    ->required(),
            ]);
    }
}
