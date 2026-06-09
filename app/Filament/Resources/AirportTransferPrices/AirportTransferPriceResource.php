<?php

namespace App\Filament\Resources\AirportTransferPrices;

use App\Filament\Resources\AirportTransferPrices\Pages\CreateAirportTransferPrice;
use App\Filament\Resources\AirportTransferPrices\Pages\EditAirportTransferPrice;
use App\Filament\Resources\AirportTransferPrices\Pages\ListAirportTransferPrices;
use App\Filament\Resources\AirportTransferPrices\Schemas\AirportTransferPriceForm;
use App\Filament\Resources\AirportTransferPrices\Tables\AirportTransferPricesTable;
use App\Models\AirportTransferPrice;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AirportTransferPriceResource extends Resource
{
    protected static ?string $model = AirportTransferPrice::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Schema $schema): Schema
    {
        return AirportTransferPriceForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AirportTransferPricesTable::configure($table);
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
            'index' => ListAirportTransferPrices::route('/'),
            'create' => CreateAirportTransferPrice::route('/create'),
            'edit' => EditAirportTransferPrice::route('/{record}/edit'),
        ];
    }
}
