<?php

namespace App\Filament\Resources\PaymentResource\Tables;

use Filament\Actions\Action;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PaymentTable
{
    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (Builder $query) => $query->whereNotNull('status'))
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID Pesanan')
                    ->formatStateUsing(fn ($state) => '#' . str_pad($state, 5, '0', STR_PAD_LEFT))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('Pelanggan')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('car.name')
                    ->label('Mobil')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('payment_method')
                    ->label('Metode Bayar')
                    ->formatStateUsing(function ($state) {
                        return match($state) {
                            'bank_transfer' => '🏦 Transfer Bank (Midtrans)',
                            'gopay' => '💳 GoPay (Midtrans)',
                            'credit_card' => '💰 Kartu Kredit (Midtrans)',
                            'transfer_manual' => '🏦 Transfer Manual',
                            'tunai' => '💵 Tunai',
                            default => $state ? '⚡ ' . ucfirst(str_replace('_', ' ', $state)) : '—',
                        };
                    })
                    ->badge()
                    ->color(fn ($state) => match($state) {
                        'bank_transfer', 'gopay', 'credit_card' => 'primary',
                        'transfer_manual' => 'info',
                        'tunai' => 'success',
                        default => 'warning',
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('total_price')
                    ->label('Nominal')
                    ->money('IDR', locale: 'id')
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->formatStateUsing(function ($state) {
                        return match($state) {
                            'pending' => '⏳ Menunggu Review',
                            'menunggu pembayaran' => '💳 Menunggu Bayar',
                            'disetujui' => '✅ Disetujui',
                            'berjalan' => '🚗 Berjalan',
                            'selesai' => '✓ Selesai',
                            'dibatalkan' => '✗ Dibatalkan',
                            default => ucfirst($state),
                        };
                    })
                    ->badge()
                    ->color(fn ($state) => match($state) {
                        'pending' => 'warning',
                        'menunggu pembayaran' => 'info',
                        'disetujui' => 'success',
                        'berjalan' => 'primary',
                        'selesai' => 'gray',
                        'dibatalkan' => 'danger',
                        default => 'secondary',
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('proof_status')
                    ->label('Bukti')
                    ->formatStateUsing(function ($record) {
                        if ($record->payment_method !== 'transfer_manual') {
                            return '—';
                        }
                        return ($record->proof_image || $record->proof_link) ? '✅ Ada' : '⏳ Belum';
                    })
                    ->badge()
                    ->color(fn ($record) =>
                        $record->payment_method !== 'transfer_manual' ? 'gray' :
                        ($record->proof_image || $record->proof_link ? 'success' : 'warning')
                    ),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime('d M Y')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('payment_method')
                    ->label('Metode')
                    ->options([
                        'transfer_manual' => 'Transfer Manual',
                        'tunai' => 'Tunai',
                    ]),

                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Menunggu Review',
                        'menunggu pembayaran' => 'Menunggu Bayar',
                        'disetujui' => 'Disetujui',
                        'berjalan' => 'Berjalan',
                        'selesai' => 'Selesai',
                        'dibatalkan' => 'Dibatalkan',
                    ]),
            ])
            ->recordActions([
                ViewAction::make(),
                Action::make('verify')
                    ->label('Verifikasi')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn ($record) => $record->payment_method === 'transfer_manual' && $record->status === 'pending')
                    ->modalHeading('Verifikasi Pembayaran Transfer Manual')
                    ->action(fn ($record) => $record->update(['status' => 'disetujui']))
                    ->successNotificationTitle('Pembayaran Berhasil Diverifikasi'),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
