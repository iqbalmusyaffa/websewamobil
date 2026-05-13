<?php

namespace App\Filament\Resources\PaymentResource\Pages;

use App\Filament\Resources\PaymentResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPayment extends ViewRecord
{
    protected static string $resource = PaymentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('mark_verified')
                ->label('Verifikasi Pembayaran')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->visible(fn () => $this->record->payment_method === 'transfer_manual' && $this->record->status === 'pending')
                ->action(function () {
                    $this->record->update(['status' => 'disetujui']);
                    $this->redirect($this->previousUrl ?? static::getResource()::getUrl('index'));
                })
                ->successNotificationTitle('Pembayaran Berhasil Diverifikasi'),
        ];
    }
}
