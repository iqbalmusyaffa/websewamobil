<?php

namespace App\Filament\Resources\BugBountyPrograms\Pages;

use App\Filament\Resources\BugBountyPrograms\BugBountyProgramResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditBugBountyProgram extends EditRecord
{
    protected static string $resource = BugBountyProgramResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
