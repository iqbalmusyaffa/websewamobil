<?php

namespace App\Filament\Resources\CarUnits;

use App\Filament\Resources\CarUnits\Pages\CreateCarUnit;
use App\Filament\Resources\CarUnits\Pages\EditCarUnit;
use App\Filament\Resources\CarUnits\Pages\ListCarUnits;
use App\Filament\Resources\CarUnits\Schemas\CarUnitForm;
use App\Filament\Resources\CarUnits\Tables\CarUnitsTable;
use App\Models\CarUnit;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class CarUnitResource extends Resource
{
    protected static ?string $model = CarUnit::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Unit Mobil';

    protected static string|UnitEnum|null $navigationGroup = 'Manajemen Armada';

    protected static ?int $navigationSort = 2;

    protected static ?string $recordTitleAttribute = 'license_plate';

    public static function form(Schema $schema): Schema
    {
        return CarUnitForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CarUnitsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            \App\Filament\Resources\CarUnits\RelationManagers\MaintenanceLogsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCarUnits::route('/'),
            'create' => CreateCarUnit::route('/create'),
            'edit' => EditCarUnit::route('/{record}/edit'),
        ];
    }
}
