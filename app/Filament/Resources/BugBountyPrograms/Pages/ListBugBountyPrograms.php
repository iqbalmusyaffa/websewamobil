<?php

namespace App\Filament\Resources\BugBountyPrograms\Pages;

use App\Filament\Resources\BugBountyPrograms\BugBountyProgramResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBugBountyPrograms extends ListRecords
{
    protected static string $resource = BugBountyProgramResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
