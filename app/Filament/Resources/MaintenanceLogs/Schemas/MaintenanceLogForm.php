<?php

namespace App\Filament\Resources\MaintenanceLogs\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class MaintenanceLogForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\Select::make('car_id')
                    ->relationship('car', 'name')
                    ->label('Mobil')
                    ->required()
                    ->searchable(),
                \Filament\Forms\Components\Select::make('car_unit_id')
                    ->relationship('carUnit', 'license_plate')
                    ->label('Plat Nomor (Unit)')
                    ->searchable()
                    ->nullable(),
                \Filament\Forms\Components\Select::make('type')
                    ->label('Jenis Maintenance')
                    ->options([
                        'Servis Rutin' => 'Servis Rutin',
                        'Ganti Oli' => 'Ganti Oli',
                        'Ganti Ban' => 'Ganti Ban',
                        'Perpanjang STNK' => 'Perpanjang STNK',
                        'Perbaikan Mesin' => 'Perbaikan Mesin',
                        'Pembersihan/Cuci' => 'Pembersihan/Cuci',
                        'Lainnya' => 'Lainnya',
                    ])
                    ->required(),
                TextInput::make('cost')
                    ->label('Biaya')
                    ->numeric()
                    ->prefix('Rp'),
                DatePicker::make('service_date')
                    ->label('Tanggal Servis')
                    ->required(),
                DatePicker::make('next_service_date')
                    ->label('Tanggal Servis Berikutnya (Opsional)'),
                TextInput::make('technician')
                    ->label('Nama Teknisi/Bengkel'),
                Textarea::make('description')
                    ->label('Deskripsi Detail')
                    ->columnSpanFull(),
            ]);
    }
}
