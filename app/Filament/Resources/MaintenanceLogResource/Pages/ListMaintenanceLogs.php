<?php

namespace App\Filament\Resources\MaintenanceLogResource\Pages;

use App\Filament\Resources\MaintenanceLogResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions;

class ListMaintenanceLogs extends ListRecords
{
    protected static string $resource = MaintenanceLogResource::class;
    protected function getHeaderActions(): array { return [Actions\CreateAction::make()]; }
}
