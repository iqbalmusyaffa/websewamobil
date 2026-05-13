<?php

namespace App\Filament\Resources\Documents\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class DocumentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required()
                    ->label('Pengguna'),
                \Filament\Schemas\Components\Tabs::make('Upload KTP')
                    ->tabs([
                        \Filament\Schemas\Components\Tabs\Tab::make('Upload File')
                            ->schema([
                                FileUpload::make('ktp_path')
                                    ->label('Upload KTP')
                                    ->image()
                                    ->disk('public')
                                    ->directory('documents/ktp')
                                    ->helperText('Upload foto/scan KTP (JPG, PNG, PDF)'),
                            ]),
                        \Filament\Schemas\Components\Tabs\Tab::make('Link / URL Drive')
                            ->schema([
                                TextInput::make('ktp_link')
                                    ->label('URL Google Drive / Link Lain')
                                    ->url()
                                    ->dehydrated(false)
                                    ->helperText('Paste link sharing dari Google Drive atau sumber lain'),
                            ]),
                    ]),
                \Filament\Schemas\Components\Tabs::make('Upload SIM')
                    ->tabs([
                        \Filament\Schemas\Components\Tabs\Tab::make('Upload File')
                            ->schema([
                                FileUpload::make('sim_path')
                                    ->label('Upload SIM')
                                    ->image()
                                    ->disk('public')
                                    ->directory('documents/sim')
                                    ->helperText('Upload foto/scan SIM (JPG, PNG, PDF)'),
                            ]),
                        \Filament\Schemas\Components\Tabs\Tab::make('Link / URL Drive')
                            ->schema([
                                TextInput::make('sim_link')
                                    ->label('URL Google Drive / Link Lain')
                                    ->url()
                                    ->dehydrated(false)
                                    ->helperText('Paste link sharing dari Google Drive atau sumber lain'),
                            ]),
                    ]),
                Select::make('status')
                    ->options(['pending' => 'Pending', 'disetujui' => 'Disetujui', 'ditolak' => 'Ditolak'])
                    ->default('pending')
                    ->required(),
            ]);
    }
}
