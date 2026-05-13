<?php

namespace App\Filament\Resources\Bookings\RelationManagers;

use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Hidden;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class InspectionsRelationManager extends RelationManager
{
    protected static string $relationship = 'inspections';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Hidden::make('car_unit_id')
                    ->default(fn ($livewire) => $livewire->ownerRecord->car_unit_id)
                    ->required(),
                Hidden::make('inspector_id')
                    ->default(fn () => auth()->id())
                    ->required(),
                Select::make('type')
                    ->label('Jenis Inspeksi')
                    ->options([
                        'pre_rental' => 'Pre-Rental (Sebelum Disewa)',
                        'post_rental' => 'Post-Rental (Setelah Kembali)',
                    ])
                    ->required(),
                Select::make('fuel_level')
                    ->label('Indikator BBM')
                    ->options([
                        'Empty' => 'Empty (Kosong)',
                        '1/4' => '1/4',
                        '1/2' => '1/2 (Setengah)',
                        '3/4' => '3/4',
                        'Full' => 'Full (Penuh)',
                    ])
                    ->default('1/2')
                    ->required(),
                TextInput::make('odometer')
                    ->label('Kilometer (Odometer)')
                    ->numeric()
                    ->required()
                    ->default(0),
                Toggle::make('is_clean_exterior')
                    ->label('Eksterior Bersih?')
                    ->default(true),
                Toggle::make('is_clean_interior')
                    ->label('Interior Bersih?')
                    ->default(true),
                Textarea::make('exterior_notes')
                    ->label('Catatan Eksterior (Baret/Penyok dll)')
                    ->columnSpanFull(),
                Textarea::make('interior_notes')
                    ->label('Catatan Interior (Kotor/Bau dll)')
                    ->columnSpanFull(),
                FileUpload::make('photos')
                    ->label('Foto Bukti (Maks 4)')
                    ->multiple()
                    ->maxFiles(4)
                    ->directory('inspection-photos')
                    ->image()
                    ->columnSpanFull(),
            ]);
    }

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('type'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('type')
            ->columns([
                TextColumn::make('type')
                    ->label('Jenis')
                    ->badge()
                    ->colors([
                        'primary' => 'pre_rental',
                        'success' => 'post_rental',
                    ])
                    ->formatStateUsing(fn ($state) => $state === 'pre_rental' ? 'Pre-Rental' : 'Post-Rental'),
                TextColumn::make('inspector.name')
                    ->label('Inspektur'),
                TextColumn::make('odometer')
                    ->label('KM')
                    ->numeric(),
                TextColumn::make('fuel_level')
                    ->label('BBM'),
                TextColumn::make('created_at')
                    ->label('Waktu')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
                AssociateAction::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DissociateAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DissociateBulkAction::make(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
