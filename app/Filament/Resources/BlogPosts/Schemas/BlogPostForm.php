<?php

namespace App\Filament\Resources\BlogPosts\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Schema;

class BlogPostForm
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
                TextInput::make('author')
                    ->required()
                    ->default('Admin AutoRent'),
                Select::make('category')
                    ->options([
                        'Tips' => 'Tips',
                        'Teknologi' => 'Teknologi',
                        'Berita' => 'Berita',
                        'Tutorial' => 'Tutorial',
                        'Review' => 'Review',
                        'Lifestyle' => 'Lifestyle',
                    ])
                    ->required(),
                FileUpload::make('featured_image')
                    ->image()
                    ->directory('blog-posts'),
                Textarea::make('excerpt')
                    ->rows(3)
                    ->columnSpanFull()
                    ->helperText('Ringkasan singkat artikel yang muncul di halaman blog list'),
                RichEditor::make('content')
                    ->required()
                    ->columnSpanFull()
                    ->helperText('Konten lengkap artikel dengan informasi detail'),
                Select::make('status')
                    ->options([
                        'Published' => 'Published',
                        'Draft' => 'Draft'
                    ])
                    ->default('Draft')
                    ->required(),
                DateTimePicker::make('published_at')
                    ->label('publikasi Tanggal'),
            ]);
    }
}
