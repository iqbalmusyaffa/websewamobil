<?php

namespace App\Filament\Resources\Branches;

use App\Filament\Resources\Branches\Pages\CreateBranch;
use App\Filament\Resources\Branches\Pages\EditBranch;
use App\Filament\Resources\Branches\Pages\ListBranches;
use App\Models\Branch;
use BackedEnum;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use UnitEnum;

class BranchResource extends Resource
{
    protected static ?string $model = Branch::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-building-storefront';

    protected static ?string $navigationLabel = 'Cabang';

    protected static string|UnitEnum|null $navigationGroup = 'Manajemen Armada';

    protected static ?int $navigationSort = 3;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Forms\Components\TextInput::make('name')
                ->label('Nama Cabang')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('slug')
                ->label('Slug (URL)')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('city')
                ->label('Kota')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('phone')
                ->label('Telepon')
                ->tel()
                ->maxLength(20),
            Forms\Components\TextInput::make('whatsapp')
                ->label('WhatsApp')
                ->tel()
                ->maxLength(20),
            Forms\Components\TextInput::make('email')
                ->label('Email')
                ->email()
                ->maxLength(255),
            Forms\Components\Textarea::make('address')
                ->label('Alamat Lengkap')
                ->required()
                ->maxLength(500),
            Forms\Components\Textarea::make('description')
                ->label('Deskripsi Cabang')
                ->maxLength(1000),
            \Filament\Schemas\Components\Tabs::make('Foto Cover')
                ->tabs([
                    \Filament\Schemas\Components\Tabs\Tab::make('Upload File')
                        ->schema([
                            FileUpload::make('cover_image')
                                ->label('Upload Foto Cover')
                                ->image()
                                ->disk('public')
                                ->directory('branches')
                                ->helperText('Upload foto utama cabang (JPG, PNG)'),
                        ]),
                    \Filament\Schemas\Components\Tabs\Tab::make('Link / URL Google')
                        ->schema([
                            Forms\Components\TextInput::make('cover_image_url')
                                ->label('URL Gambar')
                                ->url()
                                ->dehydrated(false)
                                ->helperText('Atau paste link gambar dari Google Photos, Unsplash, atau sumber lain'),
                        ]),
                ]),
            Forms\Components\TextInput::make('photo_source')
                ->label('Sumber Foto (Unsplash, Google Photos, dll)')
                ->maxLength(255)
                ->helperText('Cantumkan credit/sumber foto'),
            Forms\Components\TextInput::make('maps_url')
                ->label('URL Google Maps Embed')
                ->helperText('Copy iframe src dari Google Maps')
                ->maxLength(500),
            Forms\Components\TextInput::make('latitude')
                ->label('Latitude')
                ->numeric()
                ->step(0.0000001),
            Forms\Components\TextInput::make('longitude')
                ->label('Longitude')
                ->numeric()
                ->step(0.0000001),
            \Filament\Schemas\Components\Tabs::make('Galeri Foto')
                ->tabs([
                    \Filament\Schemas\Components\Tabs\Tab::make('Upload File')
                        ->schema([
                            FileUpload::make('gallery_images')
                                ->label('Upload Galeri Foto')
                                ->image()
                                ->multiple()
                                ->disk('public')
                                ->directory('branches/gallery')
                                ->helperText('Upload multiple foto untuk galeri'),
                        ]),
                    \Filament\Schemas\Components\Tabs\Tab::make('Paste URL')
                        ->schema([
                            Forms\Components\Textarea::make('gallery_urls')
                                ->label('URL Foto Galeri')
                                ->dehydrated(false)
                                ->helperText('Paste link foto, satu per baris. Contoh:' . "\n" . 'https://images.unsplash.com/photo-1...' . "\n" . 'https://images.unsplash.com/photo-2...'),
                        ]),
                ]),
            Forms\Components\TextInput::make('total_vehicles')
                ->label('Jumlah Mobil')
                ->numeric()
                ->default(0),
            Forms\Components\TextInput::make('total_reviews')
                ->label('Jumlah Ulasan')
                ->numeric()
                ->default(0),
            Forms\Components\TextInput::make('rating')
                ->label('Rating (0-5)')
                ->numeric()
                ->step(0.1)
                ->minValue(0)
                ->maxValue(5),
            Forms\Components\TextInput::make('sort_order')
                ->label('Urutan Tampil')
                ->numeric()
                ->default(0),
            Forms\Components\Toggle::make('is_active')
                ->label('Aktif')
                ->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Cabang')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('city')
                    ->label('Kota')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label('Telepon')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('total_vehicles')
                    ->label('Mobil')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('rating')
                    ->label('Rating')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_reviews')
                    ->label('Ulasan')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status'),
            ])
            ->recordActions([
                \Filament\Actions\EditAction::make(),
                \Filament\Actions\DeleteAction::make(),
            ])
            ->toolbarActions([\Filament\Actions\BulkActionGroup::make([\Filament\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBranches::route('/'),
            'create' => CreateBranch::route('/create'),
            'edit' => EditBranch::route('/{record}/edit'),
        ];
    }
}
