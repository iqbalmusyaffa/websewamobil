<?php

namespace App\Filament\Resources\Bookings\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BookingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('car.name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('carUnit.license_plate')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('start_date')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('end_date')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('pickup_location')
                    ->searchable(),
                IconColumn::make('with_driver')
                    ->boolean(),
                TextColumn::make('driver.name')
                    ->label('Supir')
                    ->placeholder('-')
                    ->toggleable(),
                TextColumn::make('payment_status')
                    ->label('Pembayaran')
                    ->badge()
                    ->colors([
                        'danger' => 'unpaid',
                        'warning' => 'partial',
                        'success' => 'paid',
                    ]),
                TextColumn::make('total_price')
                    ->money()
                    ->sortable(),
                TextColumn::make('status')
                    ->badge(),
                TextColumn::make('deposit_status')
                    ->label('Deposit')
                    ->badge()
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'held',
                        'primary' => 'refunded',
                        'danger' => 'forfeited',
                    ]),
                TextColumn::make('actual_return_date')
                    ->label('Tgl Kembali')
                    ->dateTime()
                    ->placeholder('-')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('penalty_fee')
                    ->label('Denda')
                    ->money()
                    ->placeholder('-')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('cancelled_reason')
                    ->label('Alasan Pembatalan')
                    ->placeholder('-')
                    ->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('refund_percentage')
                    ->label('Refund %')
                    ->placeholder('-')
                    ->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('refund_amount')
                    ->label('Jumlah Refund')
                    ->money()
                    ->placeholder('-')
                    ->toggleable(isToggledHiddenByDefault: false),
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
                \Filament\Actions\Action::make('cetak_kwitansi')
                    ->label('Cetak Kwitansi PDF')
                    ->icon('heroicon-o-printer')
                    ->color('success')
                    ->url(fn (\App\Models\Booking $record) => route('admin.invoice.download', $record))
                    ->openUrlInNewTab(),
                \Filament\Tables\Actions\Action::make('kembalikan_deposit')
                    ->label('Kembalikan Deposit')
                    ->icon('heroicon-o-wallet')
                    ->color('warning')
                    ->requiresConfirmation()
                    ->modalHeading('Kembalikan Deposit ke Saldo (Wallet) Pengguna')
                    ->modalDescription('Apakah Anda yakin ingin mengembalikan deposit uang jaminan ini ke Saldo Wallet pengguna?')
                    ->form([
                        \Filament\Forms\Components\TextInput::make('refund_amount')
                            ->label('Nominal yang Dikembalikan')
                            ->numeric()
                            ->required()
                            ->default(fn (\App\Models\Booking $record) => $record->deposit_amount)
                            ->maxValue(fn (\App\Models\Booking $record) => $record->deposit_amount)
                            ->prefix('Rp')
                            ->helperText('Anda bisa mengurangi nominal jika ada kerusakan.'),
                        \Filament\Forms\Components\Textarea::make('notes')
                            ->label('Catatan Tambahan (Opsional)')
                    ])
                    ->action(function (\App\Models\Booking $record, array $data) {
                        $amount = (float) $data['refund_amount'];
                        $user = $record->user;
                        
                        if ($amount > 0 && $user) {
                            $user->wallet_balance += $amount;
                            $user->save();
                        }
                        
                        $record->update([
                            'deposit_status' => 'refunded',
                            'deposit_refund_date' => now(),
                        ]);
                        
                        \Filament\Notifications\Notification::make()
                            ->title('Deposit Berhasil Dikembalikan')
                            ->body("Nominal Rp " . number_format($amount, 0, ',', '.') . " telah ditambahkan ke Wallet pengguna.")
                            ->success()
                            ->send();
                    })
                    ->visible(fn (\App\Models\Booking $record) => $record->deposit_amount > 0 && in_array($record->deposit_status, ['pending', 'held']) && in_array($record->status, ['selesai', 'dibatalkan'])),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
