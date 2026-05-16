<?php

namespace App\Filament\Resources\BookingExtensions\Pages;

use App\Filament\Resources\BookingExtensions\BookingExtensionResource;
use Filament\Resources\Pages\CreateRecord;

class CreateBookingExtension extends CreateRecord
{
    protected static string $resource = BookingExtensionResource::class;
}
