<?php

namespace App\Filament\Resources\PaymentResource\Schemas;

use Filament\Forms\Components\Placeholder;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class PaymentForm
{
    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Informasi Pembayaran')->schema([
                Select::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Menunggu Review',
                        'menunggu pembayaran' => 'Menunggu Pembayaran',
                        'disetujui' => 'Disetujui',
                        'berjalan' => 'Sedang Berjalan',
                        'selesai' => 'Selesai',
                        'dibatalkan' => 'Dibatalkan',
                    ])
                    ->required(),
                Placeholder::make('midtrans_note')
                    ->label('')
                    ->content('💡 <strong>Midtrans (Bank Transfer, GoPay, Kartu Kredit):</strong> Status otomatis berubah via callback Midtrans. Tidak perlu manual verification.')
                    ->visible(fn ($record) => $record && in_array($record->payment_method, ['bank_transfer', 'gopay', 'credit_card'])),
            ])->columns(1),
        ]);
    }
}
