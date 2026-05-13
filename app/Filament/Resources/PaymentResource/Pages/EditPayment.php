<?php

namespace App\Filament\Resources\PaymentResource\Pages;

use App\Filament\Resources\PaymentResource;
use Filament\Resources\Pages\EditRecord;

class EditPayment extends EditRecord
{
    protected static string $resource = PaymentResource::class;

    public function mount(int | string $record): void
    {
        redirect(static::getResource()::getUrl('view', ['record' => $record]))->send();
    }
}
