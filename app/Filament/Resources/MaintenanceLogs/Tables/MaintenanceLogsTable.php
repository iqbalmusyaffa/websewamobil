<?php

namespace App\Filament\Resources\MaintenanceLogs\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MaintenanceLogsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('car.name')
                    ->label('Mobil')
                    ->sortable(),
                TextColumn::make('carUnit.license_plate')
                    ->label('Unit (Plat)')
                    ->sortable(),
                TextColumn::make('type')
                    ->label('Jenis')
                    ->searchable()
                    ->badge(),
                TextColumn::make('cost')
                    ->label('Biaya')
                    ->money('IDR')
                    ->sortable(),
                TextColumn::make('service_date')
                    ->label('Tanggal Servis')
                    ->date()
                    ->sortable(),
                TextColumn::make('next_service_date')
                    ->label('Servis Berikutnya')
                    ->date()
                    ->sortable(),
                TextColumn::make('technician')
                    ->label('Teknisi')
                    ->searchable(),
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
