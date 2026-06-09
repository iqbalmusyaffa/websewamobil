<?php

namespace App\Filament\Resources\ShuttleBookings\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ShuttleBookingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('booking_code')
                    ->searchable(),
                TextColumn::make('user.name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('route.origin_city')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('travel_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('pickup_lat')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('pickup_lng')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('dropoff_lat')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('dropoff_lng')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('include_snack')
                    ->boolean(),
                IconColumn::make('include_meal')
                    ->boolean(),
                IconColumn::make('meal_upgrade')
                    ->boolean(),
                TextColumn::make('total_price')
                    ->money()
                    ->sortable(),
                TextColumn::make('status')
                    ->badge(),
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
