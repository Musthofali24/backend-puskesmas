<?php

namespace App\Filament\Resources\Blogs\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class BlogForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Utama')
                    ->description('Informasi dasar artikel/blog')
                    ->schema([
                        TextInput::make('title')
                            ->label('Judul')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn($state, callable $set) => $set('slug', \Illuminate\Support\Str::slug($state))),

                        TextInput::make('slug')
                            ->label('Slug (URL)')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->helperText('URL-friendly version dari judul')
                            ->disabled()
                            ->dehydrated(),

                        Select::make('category')
                            ->label('Kategori')
                            ->options([
                                'berita-kesehatan' => 'Berita Kesehatan',
                                'promosi-kesehatan' => 'Promosi Kesehatan',
                                'artikel-kesehatan' => 'Artikel Kesehatan',
                                'kegiatan-puskesmas' => 'Kegiatan Puskesmas',
                            ])
                            ->required()
                            ->default('artikel-kesehatan')
                            ->native(false),

                        FileUpload::make('featured_image')
                            ->label('Gambar Utama')
                            ->image()
                            ->directory('blog-images')
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '16:9',
                                '4:3',
                                '1:1',
                            ])
                            ->maxSize(2048)
                            ->helperText('Maksimal 2MB. Rekomendasi: 1200x630px'),
                    ])
                    ->columns(1)
                    ->columnSpan(1),

                Section::make('Metadata & Pengaturan')
                    ->description('Informasi tambahan dan pengaturan publikasi')
                    ->schema([
                        TextInput::make('author')
                            ->label('Penulis')
                            ->default('Admin Puskesmas')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('read_time')
                            ->label('Waktu Baca (menit)')
                            ->numeric()
                            ->default(5)
                            ->minValue(1)
                            ->maxValue(60)
                            ->suffix('menit')
                            ->helperText('Estimasi waktu baca artikel'),

                        Toggle::make('is_published')
                            ->label('Publikasikan')
                            ->default(false)
                            ->live()
                            ->helperText('Aktifkan untuk mempublikasikan artikel'),

                        DateTimePicker::make('published_at')
                            ->label('Tanggal Publikasi')
                            ->default(now())
                            ->native(false)
                            ->displayFormat('d/m/Y H:i')
                            ->seconds(false)
                            ->visible(fn($get) => $get('is_published'))
                            ->required(fn($get) => $get('is_published')),

                        TextInput::make('views_count')
                            ->label('Jumlah Pembaca')
                            ->numeric()
                            ->default(0)
                            ->disabled()
                            ->dehydrated(false)
                            ->helperText('Otomatis bertambah saat artikel dibaca'),
                    ])
                    ->columns(1)
                    ->columnSpan(1),


                Section::make('Konten')
                    ->description('Konten utama artikel')
                    ->schema([
                        Textarea::make('excerpt')
                            ->label('Ringkasan/Excerpt')
                            ->rows(3)
                            ->maxLength(500)
                            ->helperText('Ringkasan singkat yang akan ditampilkan di preview (maksimal 500 karakter)'),

                        RichEditor::make('content')
                            ->label('Konten Lengkap')
                            ->required()
                            ->toolbarButtons([
                                'attachFiles',
                                'blockquote',
                                'bold',
                                'bulletList',
                                'codeBlock',
                                'h1',
                                'h2',
                                'h3',
                                'italic',
                                'link',
                                'orderedList',
                                'redo',
                                'strike',
                                'underline',
                                'undo',
                            ])
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsDirectory('blog-attachments')
                            ->fileAttachmentsVisibility('public')
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
