<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaymentResource\Pages;
use App\Filament\Resources\PaymentResource\Schemas\PaymentForm;
use App\Filament\Resources\PaymentResource\Tables\PaymentTable;
use App\Models\Booking;
use BackedEnum;
use UnitEnum;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables\Table;

class PaymentResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-credit-card';
    protected static ?string $navigationLabel = 'Pembayaran';
    protected static UnitEnum|string|null $navigationGroup = 'Transaksi';
    protected static ?int $navigationSort = 2;
    protected static ?string $slug = 'payments';

    protected static bool $hasCreatePage = false;
    protected static bool $hasEditPage = false;

    public static function form(Schema $schema): Schema
    {
        return PaymentForm::form($schema);
    }

    public static function table(Table $table): Table
    {
        return PaymentTable::table($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPayments::route('/'),
            'create' => Pages\CreatePayment::route('/create'),
            'view' => Pages\ViewPayment::route('/{record}'),
            'edit' => Pages\EditPayment::route('/{record}/edit'),
        ];
    }
}
