<?php

namespace App\Filament\Resources\AirportZones;

use App\Filament\Resources\AirportZones\Pages\CreateAirportZone;
use App\Filament\Resources\AirportZones\Pages\EditAirportZone;
use App\Filament\Resources\AirportZones\Pages\ListAirportZones;
use App\Filament\Resources\AirportZones\Schemas\AirportZoneForm;
use App\Filament\Resources\AirportZones\Tables\AirportZonesTable;
use App\Models\AirportZone;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AirportZoneResource extends Resource
{
    protected static ?string $model = AirportZone::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return AirportZoneForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AirportZonesTable::configure($table);
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
            'index' => ListAirportZones::route('/'),
            'create' => CreateAirportZone::route('/create'),
            'edit' => EditAirportZone::route('/{record}/edit'),
        ];
    }
}
