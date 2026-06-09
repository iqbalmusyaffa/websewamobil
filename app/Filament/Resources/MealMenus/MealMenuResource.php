<?php

namespace App\Filament\Resources\MealMenus;

use App\Filament\Resources\MealMenus\Pages\CreateMealMenu;
use App\Filament\Resources\MealMenus\Pages\EditMealMenu;
use App\Filament\Resources\MealMenus\Pages\ListMealMenus;
use App\Filament\Resources\MealMenus\Schemas\MealMenuForm;
use App\Filament\Resources\MealMenus\Tables\MealMenusTable;
use App\Models\MealMenu;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class MealMenuResource extends Resource
{
    protected static ?string $model = MealMenu::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return MealMenuForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MealMenusTable::configure($table);
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
            'index' => ListMealMenus::route('/'),
            'create' => CreateMealMenu::route('/create'),
            'edit' => EditMealMenu::route('/{record}/edit'),
        ];
    }
}
