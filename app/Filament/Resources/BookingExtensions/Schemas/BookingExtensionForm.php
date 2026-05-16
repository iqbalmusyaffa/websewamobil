<?php

namespace App\Filament\Resources\BookingExtensions\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;

class BookingExtensionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Review Perpanjangan')
                    ->schema([
                        Select::make('status')
                            ->label('Status Persetujuan')
                            ->options([
                                'pending'  => '⏳ Menunggu',
                                'approved' => '✅ Disetujui',
                                'rejected' => '❌ Ditolak',
                            ])
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set) {
                                if ($state === 'approved') {
                                    $set('approved_by', auth()->id());
                                    $set('approved_at', now());
                                }
                            }),
                        
                        Textarea::make('admin_notes')
                            ->label('Catatan Admin (Opsional)')
                            ->rows(3)
                            ->placeholder('Contoh: Disetujui, harap segera bayar via transfer...'),
                    ]),
            ]);
    }
}
