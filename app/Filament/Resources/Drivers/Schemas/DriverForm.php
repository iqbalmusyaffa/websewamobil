<?php

namespace App\Filament\Resources\Drivers\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class DriverForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Supir')
                    ->required()
                    ->maxLength(255),
                TextInput::make('phone')
                    ->label('Nomor Telepon')
                    ->tel()
                    ->required()
                    ->maxLength(20),
                TextInput::make('ktp_number')
                    ->label('Nomor KTP')
                    ->maxLength(20),
                TextInput::make('sim_number')
                    ->label('Nomor SIM')
                    ->maxLength(20),
                Select::make('status')
                    ->label('Status')
                    ->options([
                        'available' => 'Tersedia',
                        'busy' => 'Sedang Mengantar',
                        'off' => 'Libur',
                    ])
                    ->default('available')
                    ->required(),
                Textarea::make('notes')
                    ->label('Catatan')
                    ->placeholder('Catatan tambahan tentang supir...'),
            ]);
    }
}
