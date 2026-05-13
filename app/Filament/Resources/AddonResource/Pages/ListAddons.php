<?php

namespace App\Filament\Resources\AddonResource\Pages;

use App\Filament\Resources\AddonResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions;

class ListAddons extends ListRecords
{
    protected static string $resource = AddonResource::class;
    protected function getHeaderActions(): array { return [Actions\CreateAction::make()]; }
}
