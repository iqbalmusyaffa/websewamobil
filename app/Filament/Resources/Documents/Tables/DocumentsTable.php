<?php

namespace App\Filament\Resources\Documents\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DocumentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Nama Pengguna')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('ktp_path')
                    ->label('KTP')
                    ->formatStateUsing(fn ($state) => $state ? 'Lihat KTP' : '-')
                    ->url(fn ($record) => $record->ktp_path
                        ? route('document.secure', [
                            'document' => $record->id,
                            'type' => 'ktp',
                        ])
                        : null
                    )
                    ->openUrlInNewTab()
                    ->color('primary')
                    ->searchable(),

                TextColumn::make('sim_path')
                    ->label('SIM')
                    ->formatStateUsing(fn ($state) => $state ? 'Lihat SIM' : '-')
                    ->url(fn ($record) => $record->sim_path
                        ? route('document.secure', [
                            'document' => $record->id,
                            'type' => 'sim',
                        ])
                        : null
                    )
                    ->openUrlInNewTab()
                    ->color('primary')
                    ->searchable(),

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
                Action::make('lihat_pemesanan')
                    ->label('Lihat Pemesanan')
                    ->icon('heroicon-o-shopping-bag')
                    ->color('info')
                    ->url(fn ($record) => route(
                        'filament.admin.resources.bookings.index',
                        [
                            'tableFilters[user_id][value]' => $record->user_id,
                        ]
                    )),

                EditAction::make(),
            ])

            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
