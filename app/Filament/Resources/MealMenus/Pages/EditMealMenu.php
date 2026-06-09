<?php

namespace App\Filament\Resources\MealMenus\Pages;

use App\Filament\Resources\MealMenus\MealMenuResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMealMenu extends EditRecord
{
    protected static string $resource = MealMenuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
