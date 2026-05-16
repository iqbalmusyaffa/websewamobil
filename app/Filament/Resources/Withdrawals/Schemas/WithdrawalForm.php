<?php

namespace App\Filament\Resources\Withdrawals\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class WithdrawalForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required()
                    ->disabled(),
                TextInput::make('amount')
                    ->required()
                    ->numeric()
                    ->prefix('Rp')
                    ->disabled(),
                TextInput::make('bank_name')
                    ->required()
                    ->disabled(),
                TextInput::make('account_name')
                    ->required()
                    ->disabled(),
                TextInput::make('account_number')
                    ->required()
                    ->disabled(),
                \Filament\Forms\Components\Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Disetujui',
                        'rejected' => 'Ditolak',
                    ])
                    ->required(),
                Textarea::make('admin_note')
                    ->label('Catatan Admin')
                    ->columnSpanFull(),
            ]);
    }
}
