<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReviewResource\Pages;
use App\Models\Review;
use BackedEnum;
use UnitEnum;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ReviewResource extends Resource
{
    protected static ?string $model = Review::class;
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-star';
    protected static ?string $navigationLabel = 'Ulasan';
    protected static string|UnitEnum|null $navigationGroup = 'Promosi & Reward';
    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Forms\Components\Select::make('user_id')
                ->relationship('user', 'name')
                ->searchable()
                ->required(),
            Forms\Components\Select::make('booking_id')
                ->relationship('booking', 'id')
                ->searchable()
                ->required(),
            Forms\Components\Select::make('car_id')
                ->relationship('car', 'name')
                ->searchable(),
            Forms\Components\Select::make('rating')
                ->options([1=>'⭐ 1', 2=>'⭐⭐ 2', 3=>'⭐⭐⭐ 3', 4=>'⭐⭐⭐⭐ 4', 5=>'⭐⭐⭐⭐⭐ 5'])
                ->required(),
            Forms\Components\Textarea::make('comment')->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')->label('Pengguna')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('car.name')->label('Mobil')->searchable(),
                Tables\Columns\TextColumn::make('rating')->label('Rating')
                    ->formatStateUsing(fn ($state) => str_repeat('⭐', $state))
                    ->sortable(),
                Tables\Columns\TextColumn::make('comment')->label('Komentar')->limit(50),
                Tables\Columns\TextColumn::make('created_at')->label('Tanggal')->dateTime('d M Y')->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([])
            ->recordActions([\Filament\Actions\DeleteAction::make()])
            ->toolbarActions([\Filament\Actions\BulkActionGroup::make([\Filament\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReviews::route('/'),
        ];
    }
}
