<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MaintenanceLogResource\Pages;
use App\Models\MaintenanceLog;
use BackedEnum;
use UnitEnum;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class MaintenanceLogResource extends Resource
{
    protected static ?string $model = MaintenanceLog::class;
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-wrench-screwdriver';
    protected static ?string $navigationLabel = 'Log Perawatan';
    protected static string|UnitEnum|null $navigationGroup = 'Manajemen Armada';
    protected static ?int $navigationSort = 5;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Forms\Components\Select::make('car_id')->relationship('car', 'name')->searchable()->required()->label('Mobil'),
            Forms\Components\Select::make('car_unit_id')->relationship('carUnit', 'license_plate')->searchable()->nullable()->label('Unit (Plat Nomor)'),
            Forms\Components\Select::make('type')->label('Jenis Perawatan')
                ->options(['Servis Rutin' => 'Servis Rutin', 'Ganti Oli' => 'Ganti Oli', 'Ganti Ban' => 'Ganti Ban', 'Perpanjang STNK' => 'Perpanjang STNK', 'Perbaikan Body' => 'Perbaikan Body', 'Lainnya' => 'Lainnya'])
                ->required(),
            Forms\Components\TextInput::make('technician')->label('Teknisi / Bengkel')->maxLength(255),
            Forms\Components\TextInput::make('cost')->label('Biaya (Rp)')->numeric()->prefix('Rp'),
            Forms\Components\DatePicker::make('service_date')->label('Tanggal Servis')->required(),
            Forms\Components\DatePicker::make('next_service_date')->label('Jadwal Servis Berikutnya')->nullable(),
            Forms\Components\Textarea::make('description')->label('Keterangan')->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('car.name')->label('Mobil')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('carUnit.license_plate')->label('Plat Nomor'),
                Tables\Columns\TextColumn::make('type')->label('Jenis')->searchable(),
                Tables\Columns\TextColumn::make('cost')->label('Biaya')->money('IDR')->sortable(),
                Tables\Columns\TextColumn::make('service_date')->label('Tanggal Servis')->date('d M Y')->sortable(),
                Tables\Columns\TextColumn::make('next_service_date')->label('Servis Berikutnya')->date('d M Y')->sortable()
                    ->color(fn ($state) => $state && now()->diffInDays($state, false) <= 7 ? 'danger' : 'gray'),
            ])
            ->defaultSort('service_date', 'desc')
            ->recordActions([\Filament\Actions\EditAction::make(), \Filament\Actions\DeleteAction::make()])
            ->toolbarActions([\Filament\Actions\BulkActionGroup::make([\Filament\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMaintenanceLogs::route('/'),
            'create' => Pages\CreateMaintenanceLog::route('/create'),
            'edit' => Pages\EditMaintenanceLog::route('/{record}/edit'),
        ];
    }
}
