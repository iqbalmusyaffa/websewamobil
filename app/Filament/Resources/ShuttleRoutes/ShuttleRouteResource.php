<?php

namespace App\Filament\Resources\ShuttleRoutes;

use App\Filament\Resources\ShuttleRoutes\Pages\CreateShuttleRoute;
use App\Filament\Resources\ShuttleRoutes\Pages\EditShuttleRoute;
use App\Filament\Resources\ShuttleRoutes\Pages\ListShuttleRoutes;
use App\Filament\Resources\ShuttleRoutes\Schemas\ShuttleRouteForm;
use App\Filament\Resources\ShuttleRoutes\Tables\ShuttleRoutesTable;
use App\Models\ShuttleRoute;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Forms\Form;
use Filament\Forms;
use Filament\Tables;

class ShuttleRouteResource extends Resource
{
    protected static ?string $model = ShuttleRoute::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return \App\Filament\Resources\ShuttleRoutes\Schemas\ShuttleRouteForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return \App\Filament\Resources\ShuttleRoutes\Tables\ShuttleRoutesTable::configure($table);
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
            'index' => ListShuttleRoutes::route('/'),
            'create' => CreateShuttleRoute::route('/create'),
            'edit' => EditShuttleRoute::route('/{record}/edit'),
        ];
    }
}
