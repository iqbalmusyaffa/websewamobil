<?php

namespace App\Filament\Resources\ActivitylogResource\Pages;

use App\Filament\Resources\ActivitylogResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListActivitylogs extends ListRecords
{
    protected static string $resource = ActivitylogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //
        ];
    }
}
