<?php

namespace App\Filament\Resources\Cars\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class CarForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('brand')
                    ->required(),
                TextInput::make('name')
                    ->required(),
                \Filament\Forms\Components\Select::make('type')
                    ->options([
                        'SUV' => 'SUV',
                        'MPV' => 'MPV',
                        'Sedan' => 'Sedan',
                        'Hatchback' => 'Hatchback',
                        'Minibus' => 'Minibus',
                    ]),
                \Filament\Forms\Components\Select::make('transmission')
                    ->options([
                        'Manual' => 'Manual (MT)',
                        'Automatic' => 'Automatic (AT)',
                    ]),
                \Filament\Forms\Components\Select::make('fuel_type')
                    ->label('Bahan Bakar')
                    ->options([
                        'Pertalite' => 'Pertalite',
                        'Pertamax' => 'Pertamax',
                        'Pertamax Turbo' => 'Pertamax Turbo',
                        'Biosolar' => 'Biosolar',
                        'Dexlite' => 'Dexlite',
                        'Pertamina Dex' => 'Pertamina Dex',
                        'Listrik (EV)' => 'Listrik (EV)',
                        'Hybrid' => 'Hybrid',
                    ])
                    ->required(),
                TextInput::make('capacity')
                    ->numeric(),
                TextInput::make('year')
                    ->label('Tahun Kendaraan')
                    ->numeric(),
                TextInput::make('luggage')
                    ->label('Kapasitas Bagasi (Koper)')
                    ->numeric(),
                \Filament\Forms\Components\CheckboxList::make('features')
                    ->label('Fasilitas Tambahan')
                    ->options([
                        'AC' => 'AC',
                        'Bluetooth Audio' => 'Bluetooth Audio',
                        'USB Charger' => 'USB Charger',
                        'Kamera Mundur' => 'Kamera Mundur',
                        'Sensor Parkir' => 'Sensor Parkir',
                        'Sunroof' => 'Sunroof',
                        'Airbag' => 'Airbag',
                        'GPS Navigation' => 'GPS Navigation',
                    ])
                    ->columns(2)
                    ->gridDirection('row'),
                \Filament\Forms\Components\Toggle::make('can_lepas_kunci')
                    ->label('Bisa Lepas Kunci')
                    ->live()
                    ->default(true),
                TextInput::make('price_without_driver')
                    ->required(fn ($get) => $get('can_lepas_kunci'))
                    ->visible(fn ($get) => $get('can_lepas_kunci'))
                    ->numeric()
                    ->default(0)
                    ->prefix('Rp'),
                TextInput::make('price_with_driver')
                    ->required()
                    ->numeric()
                    ->prefix('Rp'),
                \Filament\Schemas\Components\Tabs::make('Image')
                    ->tabs([
                        \Filament\Schemas\Components\Tabs\Tab::make('Upload File')
                            ->schema([
                                FileUpload::make('image')
                                    ->image()
                                    ->disk('public')
                                    ->directory('cars')
                                    ->label('Foto Mobil (Upload)')
                                    ->hint('Upload file gambar dari perangkat Anda.'),
                            ]),
                        \Filament\Schemas\Components\Tabs\Tab::make('Link / URL Google')
                            ->schema([
                                TextInput::make('image_url')
                                    ->label('URL Gambar')
                                    ->url()
                                    ->dehydrated(false)
                                    ->hint('Atau paste link gambar dari Google. (Prioritas lebih tinggi dari upload file)'),
                            ]),
                    ])
                    ->columnSpanFull(),
                Textarea::make('description')
                    ->columnSpanFull(),
            ]);
    }
}
