<?php

namespace App\Filament\Resources\CarUnits\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Table;

class CarUnitsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('car.name')
                    ->label('Mobil')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('license_plate')
                    ->label('Plat Nomor')
                    ->searchable(),
                TextColumn::make('year')
                    ->label('Tahun')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('color')
                    ->label('Warna')
                    ->searchable(),
                TextColumn::make('current_odometer')
                    ->label('Odometer')
                    ->suffix(' Km')
                    ->sortable()
                    ->color(fn ($record) => $record->current_odometer >= $record->next_service_odometer ? 'danger' : null)
                    ->description(fn ($record) => $record->current_odometer >= $record->next_service_odometer ? 'Waktunya Service!' : 'Batas: ' . number_format($record->next_service_odometer, 0, ',', '.') . ' Km'),
                BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'success' => 'available',
                        'warning' => 'maintenance',
                        'danger' => 'rented',
                    ])
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'available' => 'Tersedia',
                        'maintenance' => 'Pemeliharaan',
                        'rented' => 'Disewa',
                        default => $state,
                    }),
                TextColumn::make('locked_reason')
                    ->label('Alasan Dikunci')
                    ->placeholder('-')
                    ->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('lockedByAdmin.name')
                    ->label('Dikunci oleh')
                    ->placeholder('-')
                    ->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime('d M Y H:i')
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
