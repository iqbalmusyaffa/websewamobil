<?php

namespace App\Filament\Resources\MealMenus\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms;

class MealMenuForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\TextInput::make('name')
                    ->label('Nama Menu')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Toggle::make('is_premium')
                    ->label('Menu Premium (Berbayar)')
                    ->default(false),
                Forms\Components\Toggle::make('is_active')
                    ->label('Status Aktif')
                    ->default(true),
            ]);
    }
}
