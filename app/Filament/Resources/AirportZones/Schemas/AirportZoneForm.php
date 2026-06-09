<?php

namespace App\Filament\Resources\AirportZones\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Hidden;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Http;

class AirportZoneForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Rute Utama / Zona')
                    ->required()
                    ->helperText('Contoh: Jalur Timur (Surabaya - Banyuwangi)'),

                Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true)
                    ->required(),

                \Filament\Forms\Components\Repeater::make('areas')
                    ->label('Daftar Area Perhentian (Kota/Kecamatan)')
                    ->relationship('areas')
                    ->maxItems(10)
                    ->columns(3)
                    ->components([
                        Select::make('province_id')
                            ->label('Provinsi')
                            ->options(function () {
                                $response = Http::get('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json');
                                if ($response->successful()) {
                                    return collect($response->json())->pluck('name', 'id');
                                }
                                return [];
                            })
                            ->searchable()
                            ->live()
                            ->afterStateUpdated(function ($set, ?string $state) {
                                $set('city_id', null);
                                $set('district_id', null);
                                
                                if ($state) {
                                    $response = Http::get('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json');
                                    $name = collect($response->json())->where('id', $state)->first()['name'] ?? null;
                                    $set('province_name', $name);
                                } else {
                                    $set('province_name', null);
                                }
                            })
                            ->required(),

                        Hidden::make('province_name'),

                        Select::make('city_id')
                            ->label('Kota/Kabupaten')
                            ->options(function ($get) {
                                $provinceId = $get('province_id');
                                if (!$provinceId) {
                                    return [];
                                }
                                $response = Http::get("https://www.emsifa.com/api-wilayah-indonesia/api/regencies/{$provinceId}.json");
                                if ($response->successful()) {
                                    return collect($response->json())->pluck('name', 'id');
                                }
                                return [];
                            })
                            ->searchable()
                            ->live()
                            ->afterStateUpdated(function ($set, $get, ?string $state) {
                                $set('district_id', null);
                                if ($state) {
                                    $provinceId = $get('province_id');
                                    $response = Http::get("https://www.emsifa.com/api-wilayah-indonesia/api/regencies/{$provinceId}.json");
                                    $name = collect($response->json())->where('id', $state)->first()['name'] ?? null;
                                    $set('city_name', $name);
                                } else {
                                    $set('city_name', null);
                                }
                            })
                            ->required(),

                        Hidden::make('city_name'),

                        Select::make('district_id')
                            ->label('Kecamatan (Opsional)')
                            ->options(function ($get) {
                                $cityId = $get('city_id');
                                if (!$cityId) {
                                    return [];
                                }
                                $response = Http::get("https://www.emsifa.com/api-wilayah-indonesia/api/districts/{$cityId}.json");
                                if ($response->successful()) {
                                    return collect($response->json())->pluck('name', 'id');
                                }
                                return [];
                            })
                            ->searchable()
                            ->live()
                            ->afterStateUpdated(function ($set, $get, ?string $state) {
                                if ($state) {
                                    $cityId = $get('city_id');
                                    $response = Http::get("https://www.emsifa.com/api-wilayah-indonesia/api/districts/{$cityId}.json");
                                    $name = collect($response->json())->where('id', $state)->first()['name'] ?? null;
                                    $set('district_name', $name);
                                } else {
                                    $set('district_name', null);
                                }
                            }),

                        Hidden::make('district_name'),

                        TextInput::make('discount_amount')
                            ->label('Potongan Harga (Diskon)')
                            ->numeric()
                            ->default(0)
                            ->prefix('Rp')
                            ->helperText('Diisi misal 150000 untuk tujuan yang lebih dekat.')
                            ->required(),
                    ])->columnSpanFull()
            ]);
    }
}
