<?php

namespace App\Filament\Resources\CarUnits\RelationManagers;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;

class MaintenanceLogsRelationManager extends RelationManager
{
    protected static string $relationship = 'maintenanceLogs';

    protected static ?string $recordTitleAttribute = 'type';

    protected static ?string $title = 'Riwayat Service / Pemeliharaan';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('type')
                    ->label('Jenis Service')
                    ->options([
                        'Ganti Oli' => 'Ganti Oli',
                        'Servis Rutin' => 'Servis Rutin',
                        'Ganti Ban' => 'Ganti Ban',
                        'Perpanjang STNK' => 'Perpanjang STNK',
                        'Perbaikan Mesin' => 'Perbaikan Mesin',
                        'Lainnya' => 'Lainnya',
                    ])
                    ->required()
                    ->searchable(),
                TextInput::make('cost')
                    ->label('Biaya (Rp)')
                    ->numeric()
                    ->prefix('Rp')
                    ->default(0),
                DatePicker::make('service_date')
                    ->label('Tanggal Servis')
                    ->default(now())
                    ->required(),
                DatePicker::make('next_service_date')
                    ->label('Estimasi Servis Berikutnya'),
                TextInput::make('technician')
                    ->label('Teknisi / Bengkel'),
                Textarea::make('description')
                    ->label('Catatan Servis (Parts yang diganti, dll)')
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('type')
            ->columns([
                TextColumn::make('service_date')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable(),
                TextColumn::make('type')
                    ->label('Jenis Service')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('cost')
                    ->label('Biaya')
                    ->money()
                    ->sortable(),
                TextColumn::make('technician')
                    ->label('Bengkel/Teknisi')
                    ->placeholder('-'),
                TextColumn::make('description')
                    ->label('Catatan')
                    ->limit(50),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make()
                    ->mutateFormDataUsing(function (array $data): array {
                        $data['car_id'] = $this->getOwnerRecord()->car_id;
                        return $data;
                    })
                    ->after(function (array $data) {
                        // Reset status peringatan service jika habis di-service
                        $carUnit = $this->getOwnerRecord();
                        // Jika jenis service adalah ganti oli / rutin, otomatis naikkan target odometer
                        if (in_array($data['type'] ?? '', ['Ganti Oli', 'Servis Rutin'])) {
                            $carUnit->update([
                                'next_service_odometer' => $carUnit->current_odometer + 10000
                            ]);
                        }
                    }),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                \Filament\Tables\Actions\BulkActionGroup::make([
                    \Filament\Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
