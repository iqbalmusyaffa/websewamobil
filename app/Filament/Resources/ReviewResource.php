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
            Forms\Components\Select::make('branch_id')
                ->relationship('branch', 'name')
                ->searchable(),
            Forms\Components\Select::make('rating')
                ->label('Rating Umum')
                ->options([1=>'⭐ 1', 2=>'⭐⭐ 2', 3=>'⭐⭐⭐ 3', 4=>'⭐⭐⭐⭐ 4', 5=>'⭐⭐⭐⭐⭐ 5'])
                ->required(),
            Forms\Components\Textarea::make('comment')->columnSpanFull(),
            \Filament\Schemas\Components\Fieldset::make('Kuesioner Cabang')
                ->schema([
                    Forms\Components\Select::make('service_rating')
                        ->label('Pelayanan')
                        ->options([1=>'1', 2=>'2', 3=>'3', 4=>'4', 5=>'5']),
                    Forms\Components\Select::make('friendliness_rating')
                        ->label('Keramahan Staf')
                        ->options([1=>'1', 2=>'2', 3=>'3', 4=>'4', 5=>'5']),
                ])->columns(2),
            \Filament\Schemas\Components\Fieldset::make('Kuesioner Mobil')
                ->schema([
                    Forms\Components\Select::make('cleanliness_rating')
                        ->label('Kebersihan')
                        ->options([1=>'1', 2=>'2', 3=>'3', 4=>'4', 5=>'5']),
                    Forms\Components\Select::make('comfort_rating')
                        ->label('Kenyamanan')
                        ->options([1=>'1', 2=>'2', 3=>'3', 4=>'4', 5=>'5']),
                    Forms\Components\Select::make('car_condition_rating')
                        ->label('Kondisi Mesin')
                        ->options([1=>'1', 2=>'2', 3=>'3', 4=>'4', 5=>'5']),
                ])->columns(3),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')->label('Pengguna')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('car.name')->label('Mobil')->searchable(),
                Tables\Columns\TextColumn::make('branch.name')->label('Cabang')->searchable(),
                Tables\Columns\TextColumn::make('rating')->label('Rating Umum')
                    ->formatStateUsing(fn ($state) => str_repeat('⭐', $state))
                    ->sortable(),
                Tables\Columns\TextColumn::make('service_rating')->label('Layanan')->numeric()->sortable()->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('friendliness_rating')->label('Keramahan')->numeric()->sortable()->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('cleanliness_rating')->label('Kebersihan')->numeric()->sortable()->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('comfort_rating')->label('Kenyamanan')->numeric()->sortable()->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('car_condition_rating')->label('Kond. Mesin')->numeric()->sortable()->toggleable(isToggledHiddenByDefault: true),
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
