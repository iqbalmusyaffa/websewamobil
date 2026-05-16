<?php

namespace App\Filament\Resources\Penalties\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class PenaltyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->label('Penyewa / Pengguna')
                    ->required()
                    ->searchable(),
                \Filament\Forms\Components\Select::make('booking_id')
                    ->relationship('booking', 'id')
                    ->label('ID Pemesanan (Opsional)')
                    ->searchable()
                    ->nullable(),
                TextInput::make('amount')
                    ->label('Nominal Denda')
                    ->required()
                    ->numeric()
                    ->prefix('Rp'),
                TextInput::make('reason')
                    ->label('Alasan Denda')
                    ->placeholder('Misal: Terlambat 3 hari, Baret parah, dsb.')
                    ->required(),
                \Filament\Forms\Components\Select::make('status')
                    ->label('Status Pembayaran')
                    ->options([
                        'unpaid' => 'Belum Lunas (Unpaid)',
                        'paid' => 'Lunas (Paid)',
                    ])
                    ->required()
                    ->default('unpaid'),
                Textarea::make('notes')
                    ->label('Catatan Tambahan')
                    ->columnSpanFull(),
            ]);
    }
}
