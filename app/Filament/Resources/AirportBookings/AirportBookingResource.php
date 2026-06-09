<?php

namespace App\Filament\Resources\AirportBookings;

use App\Filament\Resources\AirportBookings\Pages\CreateAirportBooking;
use App\Filament\Resources\AirportBookings\Pages\EditAirportBooking;
use App\Filament\Resources\AirportBookings\Pages\ListAirportBookings;
use App\Filament\Resources\AirportBookings\Schemas\AirportBookingForm;
use App\Filament\Resources\AirportBookings\Tables\AirportBookingsTable;
use App\Models\AirportBooking;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AirportBookingResource extends Resource
{
    protected static ?string $model = AirportBooking::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'booking_code';

    public static function form(Schema $schema): Schema
    {
        return AirportBookingForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AirportBookingsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAirportBookings::route('/'),
            'create' => CreateAirportBooking::route('/create'),
            'edit' => EditAirportBooking::route('/{record}/edit'),
        ];
    }
}
