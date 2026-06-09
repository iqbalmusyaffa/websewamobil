<?php

namespace App\Filament\Resources\ShuttleBookings\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ShuttleBookingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('booking_code')
                    ->required(),
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Select::make('shuttle_route_id')
                    ->relationship('route', 'origin_city')
                    ->required(),
                DatePicker::make('travel_date')
                    ->required(),
                Textarea::make('pickup_address')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('pickup_lat')
                    ->numeric(),
                TextInput::make('pickup_lng')
                    ->numeric(),
                Textarea::make('dropoff_address')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('dropoff_lat')
                    ->numeric(),
                TextInput::make('dropoff_lng')
                    ->numeric(),
                Toggle::make('include_snack')
                    ->required(),
                Toggle::make('include_meal')
                    ->required(),
                Toggle::make('meal_upgrade')
                    ->required(),
                TextInput::make('total_price')
                    ->required()
                    ->numeric()
                    ->prefix('Rp'),
                Select::make('status')
                    ->options(['pending' => 'Pending', 'paid' => 'Paid', 'tiket diterima' => 'Tiket Diterima', 'cancelled' => 'Cancelled'])
                    ->default('pending')
                    ->required(),
            ]);
    }
}
