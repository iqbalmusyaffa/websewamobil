<?php

namespace App\Filament\Resources\ShuttleBookings;

use App\Filament\Resources\ShuttleBookings\Pages\CreateShuttleBooking;
use App\Filament\Resources\ShuttleBookings\Pages\EditShuttleBooking;
use App\Filament\Resources\ShuttleBookings\Pages\ListShuttleBookings;
use App\Filament\Resources\ShuttleBookings\Schemas\ShuttleBookingForm;
use App\Filament\Resources\ShuttleBookings\Tables\ShuttleBookingsTable;
use App\Models\ShuttleBooking;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Forms\Form;
use Filament\Forms;
use Filament\Tables;

class ShuttleBookingResource extends Resource
{
    protected static ?string $model = ShuttleBooking::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return \App\Filament\Resources\ShuttleBookings\Schemas\ShuttleBookingForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return \App\Filament\Resources\ShuttleBookings\Tables\ShuttleBookingsTable::configure($table);
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
            'index' => ListShuttleBookings::route('/'),
            'create' => CreateShuttleBooking::route('/create'),
            'edit' => EditShuttleBooking::route('/{record}/edit'),
        ];
    }
}
