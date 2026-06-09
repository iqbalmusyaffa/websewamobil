<?php

namespace App\Filament\Resources\ShuttleRoutes\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ShuttleRoutesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('origin_city')
                    ->searchable(),
                TextColumn::make('destination_city')
                    ->searchable(),
                TextColumn::make('class_type')
                    ->badge()
                    ->searchable(),
                TextColumn::make('departure_time')
                    ->time()
                    ->sortable(),
                TextColumn::make('arrival_time')
                    ->time()
                    ->sortable(),
                TextColumn::make('base_price')
                    ->money()
                    ->sortable(),
                TextColumn::make('total_seats')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('is_active')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
