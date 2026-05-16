<?php

namespace App\Filament\Resources\MaintenanceLogs;

use App\Filament\Resources\MaintenanceLogs\Pages\CreateMaintenanceLog;
use App\Filament\Resources\MaintenanceLogs\Pages\EditMaintenanceLog;
use App\Filament\Resources\MaintenanceLogs\Pages\ListMaintenanceLogs;
use App\Filament\Resources\MaintenanceLogs\Schemas\MaintenanceLogForm;
use App\Filament\Resources\MaintenanceLogs\Tables\MaintenanceLogsTable;
use App\Models\MaintenanceLog;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class MaintenanceLogResource extends Resource
{
    protected static ?string $model = MaintenanceLog::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-wrench-screwdriver';
    protected static ?string $navigationLabel = 'Servis Armada';
    protected static string|\UnitEnum|null $navigationGroup = 'Manajemen Armada';
    protected static ?string $pluralModelLabel = 'Riwayat Servis';

    public static function form(Schema $schema): Schema
    {
        return MaintenanceLogForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MaintenanceLogsTable::configure($table);
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
            'index' => ListMaintenanceLogs::route('/'),
            'create' => CreateMaintenanceLog::route('/create'),
            'edit' => EditMaintenanceLog::route('/{record}/edit'),
        ];
    }
}
