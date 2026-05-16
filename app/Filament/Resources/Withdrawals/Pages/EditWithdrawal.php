<?php

namespace App\Filament\Resources\Withdrawals\Pages;

use App\Filament\Resources\Withdrawals\WithdrawalResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditWithdrawal extends EditRecord
{
    protected static string $resource = WithdrawalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $originalStatus = $this->record->status;
        $newStatus = $data['status'];

        if ($originalStatus !== 'rejected' && $newStatus === 'rejected') {
            // Refund wallet balance
            $user = $this->record->user;
            if ($user) {
                $user->wallet_balance += $this->record->amount;
                $user->save();
            }
        } elseif ($originalStatus === 'rejected' && $newStatus !== 'rejected') {
            // Re-deduct wallet balance
            $user = $this->record->user;
            if ($user) {
                $user->wallet_balance -= $this->record->amount;
                $user->save();
            }
        }

        return $data;
    }
}
