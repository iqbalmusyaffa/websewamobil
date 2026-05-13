<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                TextInput::make('phone')
                    ->tel(),
                Select::make('role')
                    ->options(['admin' => 'Admin', 'customer' => 'Customer'])
                    ->default('customer')
                    ->required(),
                Select::make('member_tier')
                    ->label('Membership Tier')
                    ->options([
                        'reguler' => 'Reguler',
                        'silver' => 'Silver',
                        'gold' => 'Gold',
                        'platinum' => 'Platinum',
                    ])
                    ->default('reguler')
                    ->required(),
                TextInput::make('member_points')
                    ->label('Member Points')
                    ->numeric()
                    ->default(0)
                    ->required(),
                DateTimePicker::make('email_verified_at'),
                TextInput::make('password')
                    ->password()
                    ->required(),
            ]);
    }
}
