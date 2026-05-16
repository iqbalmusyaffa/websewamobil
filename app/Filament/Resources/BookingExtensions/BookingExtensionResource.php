<?php

namespace App\Filament\Resources\BookingExtensions;

use App\Filament\Resources\BookingExtensions\Pages\CreateBookingExtension;
use App\Filament\Resources\BookingExtensions\Pages\EditBookingExtension;
use App\Filament\Resources\BookingExtensions\Pages\ListBookingExtensions;
use App\Filament\Resources\BookingExtensions\Pages\ViewBookingExtension;
use App\Filament\Resources\BookingExtensions\Schemas\BookingExtensionForm;
use App\Filament\Resources\BookingExtensions\Schemas\BookingExtensionInfolist;
use App\Filament\Resources\BookingExtensions\Tables\BookingExtensionsTable;
use App\Models\BookingExtension;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class BookingExtensionResource extends Resource
{
    protected static ?string $model = BookingExtension::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Schema $schema): Schema
    {
        return BookingExtensionForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return BookingExtensionInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BookingExtensionsTable::configure($table);
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
            'index' => ListBookingExtensions::route('/'),
            'create' => CreateBookingExtension::route('/create'),
            'view' => ViewBookingExtension::route('/{record}'),
            'edit' => EditBookingExtension::route('/{record}/edit'),
        ];
    }
}
