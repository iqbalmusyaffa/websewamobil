<?php

namespace App\Filament\Resources\BugBountyPrograms;

use App\Filament\Resources\BugBountyPrograms\Pages\CreateBugBountyProgram;
use App\Filament\Resources\BugBountyPrograms\Pages\EditBugBountyProgram;
use App\Filament\Resources\BugBountyPrograms\Pages\ListBugBountyPrograms;
use App\Filament\Resources\BugBountyPrograms\Schemas\BugBountyProgramForm;
use App\Filament\Resources\BugBountyPrograms\Tables\BugBountyProgramsTable;
use App\Models\BugBountyProgram;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class BugBountyProgramResource extends Resource
{
    protected static ?string $model = BugBountyProgram::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return BugBountyProgramForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BugBountyProgramsTable::configure($table);
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
            'index' => ListBugBountyPrograms::route('/'),
            'create' => CreateBugBountyProgram::route('/create'),
            'edit' => EditBugBountyProgram::route('/{record}/edit'),
        ];
    }
}
