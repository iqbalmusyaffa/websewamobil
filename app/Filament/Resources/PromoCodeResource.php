<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PromoCodeResource\Pages;
use App\Models\PromoCode;
use BackedEnum;
use UnitEnum;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PromoCodeResource extends Resource
{
    protected static ?string $model = PromoCode::class;
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-ticket';
    protected static ?string $navigationLabel = 'Kode Promo';
    protected static string|UnitEnum|null $navigationGroup = 'Promosi & Reward';
    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Forms\Components\TextInput::make('code')->label('Kode Promo')->required()->maxLength(50)->unique(ignoreRecord: true),
            Forms\Components\TextInput::make('description')->label('Deskripsi')->maxLength(255)->columnSpanFull(),
            Forms\Components\Select::make('type')->label('Tipe Diskon')
                ->options(['percent' => 'Persentase (%)', 'fixed' => 'Nominal Tetap (Rp)'])
                ->required()
                ->reactive(),
            Forms\Components\TextInput::make('value')->label('Nilai Diskon')->numeric()->required(),
            Forms\Components\TextInput::make('min_booking')->label('Minimum Booking (Rp)')->numeric()->default(0)->prefix('Rp'),
            Forms\Components\TextInput::make('max_discount')->label('Maksimum Diskon (Rp, opsional)')->numeric()->nullable()->prefix('Rp')
                ->visible(fn ($get) => $get('type') === 'percent'),
            Forms\Components\TextInput::make('quota')->label('Kuota (kosongkan = unlimited)')->numeric()->nullable(),
            Forms\Components\DatePicker::make('valid_from')->label('Berlaku Dari')->nullable(),
            Forms\Components\DatePicker::make('valid_until')->label('Berlaku Sampai')->nullable(),
            Forms\Components\Toggle::make('is_active')->label('Aktif')->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')->label('Kode')->searchable()->sortable()->copyable(),
                Tables\Columns\TextColumn::make('type')->label('Tipe')
                    ->formatStateUsing(fn ($state) => $state === 'percent' ? 'Persen' : 'Nominal'),
                Tables\Columns\TextColumn::make('value')->label('Nilai')
                    ->formatStateUsing(fn ($state, $record) => $record->type === 'percent' ? $state.'%' : 'Rp '.number_format($state, 0, ',', '.')),
                Tables\Columns\TextColumn::make('used_count')->label('Digunakan'),
                Tables\Columns\TextColumn::make('quota')->label('Kuota')->default('∞'),
                Tables\Columns\TextColumn::make('valid_until')->label('Berlaku Sampai')->date('d M Y')->sortable(),
                Tables\Columns\IconColumn::make('is_active')->label('Aktif')->boolean(),
            ])
            ->defaultSort('created_at', 'desc')
            ->recordActions([\Filament\Actions\EditAction::make(), \Filament\Actions\DeleteAction::make()])
            ->toolbarActions([\Filament\Actions\BulkActionGroup::make([\Filament\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPromoCodes::route('/'),
            'create' => Pages\CreatePromoCode::route('/create'),
            'edit' => Pages\EditPromoCode::route('/{record}/edit'),
        ];
    }
}
