<?php

namespace App\Filament\Resources\CarUnits\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class CarUnitForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('car_id')
                    ->relationship('car', 'name')
                    ->searchable()
                    ->preload()
                    ->label('Mobil')
                    ->required(),
                TextInput::make('license_plate')
                    ->label('Plat Nomor')
                    ->required(),
                TextInput::make('year')
                    ->label('Tahun')
                    ->required()
                    ->numeric(),
                TextInput::make('color')
                    ->label('Warna')
                    ->required(),
                TextInput::make('current_odometer')
                    ->label('Odometer Saat Ini')
                    ->numeric()
                    ->default(0)
                    ->suffix('Km'),
                TextInput::make('next_service_odometer')
                    ->label('Batas Service Berikutnya')
                    ->numeric()
                    ->default(10000)
                    ->suffix('Km')
                    ->helperText('Sistem akan memberi peringatan jika odometer saat ini mendekati atau melebihi batas ini.'),
                Select::make('status')
                    ->label('Status')
                    ->options(['available' => 'Tersedia', 'maintenance' => 'Pemeliharaan', 'rented' => 'Disewa'])
                    ->default('available')
                    ->required()
                    ->live(),
                Textarea::make('notes')
                    ->label('Catatan/Masalah')
                    ->placeholder('Catatan tentang kondisi kendaraan...'),
                Select::make('locked_by')
                    ->label('Dikunci oleh Admin')
                    ->relationship('lockedByAdmin', 'name')
                    ->searchable()
                    ->preload()
                    ->visible(fn ($get) => $get('status') === 'maintenance')
                    ->helperText('Pilih admin yang mengunci kendaraan ini'),
                TextInput::make('locked_reason')
                    ->label('Alasan Dikunci')
                    ->placeholder('Masalah mesin, ban bocor, servis rutin, dll')
                    ->visible(fn ($get) => $get('status') === 'maintenance')
                    ->required(fn ($get) => $get('status') === 'maintenance')
                    ->helperText('Wajib diisi jika status adalah Pemeliharaan'),
            ]);
    }
}
