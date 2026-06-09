<?php

namespace App\Filament\Resources\AirportBookings\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class AirportBookingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('booking_code')
                    ->required(),
                TextInput::make('user_id')
                    ->numeric(),
                Select::make('transfer_type')
                    ->options(['to_airport' => 'To airport', 'from_airport' => 'From airport'])
                    ->required(),
                TextInput::make('airport_id')
                    ->required()
                    ->numeric(),
                TextInput::make('airport_zone_id')
                    ->required()
                    ->numeric(),
                TextInput::make('car_id')
                    ->required()
                    ->numeric(),
                DateTimePicker::make('pickup_datetime')
                    ->required(),
                Textarea::make('pickup_address')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('flight_number'),
                TextInput::make('customer_name')
                    ->required(),
                TextInput::make('customer_phone')
                    ->tel()
                    ->required(),
                Textarea::make('notes')
                    ->columnSpanFull(),
                TextInput::make('total_price')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                Select::make('payment_method')
                    ->options(['transfer' => 'Transfer', 'cash' => 'Cash', 'whatsapp' => 'Whatsapp'])
                    ->required(),
                TextInput::make('payment_status')
                    ->required()
                    ->default('pending'),
                TextInput::make('booking_status')
                    ->required()
                    ->default('pending'),
            ]);
    }
}
