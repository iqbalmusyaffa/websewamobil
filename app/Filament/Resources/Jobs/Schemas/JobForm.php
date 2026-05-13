<?php

namespace App\Filament\Resources\Jobs\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\KeyValue;
use Filament\Schemas\Schema;

class JobForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->live()
                    ->afterStateUpdated(function ($state, $set) {
                        $set('slug', \Str::slug($state));
                    }),
                TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true),
                Select::make('category')
                    ->options([
                        'Engineering' => 'Engineering',
                        'Customer Success' => 'Customer Success',
                        'Marketing' => 'Marketing',
                        'Sales' => 'Sales',
                        'Design' => 'Design',
                        'HR' => 'HR',
                    ])
                    ->required(),
                TextInput::make('location')
                    ->required(),
                Select::make('type')
                    ->options([
                        'Full-time' => 'Full-time',
                        'Part-time' => 'Part-time',
                        'Contract' => 'Contract',
                        'Internship' => 'Internship',
                    ])
                    ->default('Full-time')
                    ->required(),
                Select::make('work_mode')
                    ->options([
                        'On-site' => 'On-site',
                        'Remote' => 'Remote',
                        'Hybrid' => 'Hybrid'
                    ])
                    ->default('Hybrid')
                    ->required(),
                RichEditor::make('description')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('requirements_text')
                    ->label('Requirements (one per line)')
                    ->columnSpanFull()
                    ->helperText('Enter each requirement on a new line'),
                Textarea::make('benefits_text')
                    ->label('Benefits (one per line)')
                    ->columnSpanFull()
                    ->helperText('Enter each benefit on a new line'),
                TextInput::make('salary_from')
                    ->numeric()
                    ->label('Salary From (IDR)'),
                TextInput::make('salary_to')
                    ->numeric()
                    ->label('Salary To (IDR)'),
                Select::make('status')
                    ->options([
                        'Open' => 'Open',
                        'Closed' => 'Closed',
                        'Draft' => 'Draft'
                    ])
                    ->default('Open')
                    ->required(),
            ]);
    }
}
