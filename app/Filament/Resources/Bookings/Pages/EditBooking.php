<?php

namespace App\Filament\Resources\Bookings\Pages;

use App\Filament\Resources\Bookings\BookingResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditBooking extends EditRecord
{
    protected static string $resource = BookingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\Action::make('print_invoice')
                ->label('🖨️ Cetak Invoice')
                ->url(fn () => route('bookings.invoice', $this->record))
                ->openUrlInNewTab()
                ->icon('heroicon-m-arrow-top-right-on-square'),
            DeleteAction::make(),
        ];
    }
}
