<?php

namespace App\Filament\Resources\MealMenus\Pages;

use App\Filament\Resources\MealMenus\MealMenuResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMealMenus extends ListRecords
{
    protected static string $resource = MealMenuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
