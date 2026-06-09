<?php

namespace App\Filament\Resources\BugReports;

use App\Filament\Resources\BugReports\Pages\CreateBugReport;
use App\Filament\Resources\BugReports\Pages\EditBugReport;
use App\Filament\Resources\BugReports\Pages\ListBugReports;
use App\Filament\Resources\BugReports\Pages\ViewBugReport;
use App\Filament\Resources\BugReports\Schemas\BugReportForm;
use App\Filament\Resources\BugReports\Schemas\BugReportInfolist;
use App\Filament\Resources\BugReports\Tables\BugReportsTable;
use App\Models\BugReport;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class BugReportResource extends Resource
{
    protected static ?string $model = BugReport::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return BugReportForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return BugReportInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BugReportsTable::configure($table);
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
            'index' => ListBugReports::route('/'),
            'create' => CreateBugReport::route('/create'),
            'view' => ViewBugReport::route('/{record}'),
            'edit' => EditBugReport::route('/{record}/edit'),
        ];
    }
}
