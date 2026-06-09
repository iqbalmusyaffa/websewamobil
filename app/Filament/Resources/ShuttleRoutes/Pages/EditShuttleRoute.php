<?php

namespace App\Filament\Resources\ShuttleRoutes\Pages;

use App\Filament\Resources\ShuttleRoutes\ShuttleRouteResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditShuttleRoute extends EditRecord
{
    protected static string $resource = ShuttleRouteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
