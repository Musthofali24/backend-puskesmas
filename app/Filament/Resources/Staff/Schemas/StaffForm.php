<?php

namespace App\Filament\Resources\Staff\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class StaffForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Dasar')
                    ->description('Informasi dasar karyawan')
                    ->schema([
                        FileUpload::make('photo')
                            ->label('Foto')
                            ->image()
                            ->directory('staff-photos')
                            ->imageEditor()
                            ->circleCropper()
                            ->maxSize(2048)
                            ->helperText('Upload foto karyawan (maksimal 2MB)'),

                        TextInput::make('name')
                            ->label('Nama Lengkap')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('contoh: dr. Ahmad Fauzi, Sp.PD'),

                        TextInput::make('specialty')
                            ->label('Spesialisasi/Jabatan')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('contoh: Dokter Spesialis Penyakit Dalam'),

                        Textarea::make('description')
                            ->label('Deskripsi')
                            ->required()
                            ->rows(4)
                            ->maxLength(500)
                            ->placeholder('Deskripsi singkat tentang karyawan...'),

                        Select::make('color')
                            ->label('Warna Avatar')
                            ->options([
                                'bg-teal-500' => 'Teal',
                                'bg-pink-400' => 'Pink',
                                'bg-sky-400' => 'Sky Blue',
                                'bg-purple-500' => 'Purple',
                                'bg-orange-500' => 'Orange',
                                'bg-green-500' => 'Green',
                                'bg-red-500' => 'Red',
                                'bg-indigo-500' => 'Indigo',
                            ])
                            ->default('bg-teal-500')
                            ->required()
                            ->helperText('Warna background untuk avatar jika tidak ada foto'),
                    ])
                    ->columns(2)
                    ->columnSpan(1),

                Section::make('Kontak & Sosial Media')
                    ->description('Informasi kontak dan sosial media')
                    ->schema([
                        TextInput::make('phone')
                            ->label('Nomor Telepon')
                            ->tel()
                            ->maxLength(20)
                            ->placeholder('08123456789'),

                        TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->maxLength(255)
                            ->placeholder('email@example.com'),

                        TextInput::make('whatsapp')
                            ->label('WhatsApp')
                            ->tel()
                            ->maxLength(20)
                            ->placeholder('08123456789')
                            ->helperText('Nomor WhatsApp (tanpa +62)'),

                        TextInput::make('facebook')
                            ->label('Facebook')
                            ->url()
                            ->maxLength(255)
                            ->placeholder('https://facebook.com/username'),

                        TextInput::make('instagram')
                            ->label('Instagram')
                            ->maxLength(255)
                            ->placeholder('@username atau https://instagram.com/username'),

                        TextInput::make('twitter')
                            ->label('Twitter/X')
                            ->maxLength(255)
                            ->placeholder('@username atau https://twitter.com/username'),

                        TextInput::make('linkedin')
                            ->label('LinkedIn')
                            ->url()
                            ->maxLength(255)
                            ->placeholder('https://linkedin.com/in/username'),
                    ])
                    ->columns(2)
                    ->columnSpan(1),

                Section::make('Pengaturan')
                    ->description('Pengaturan tampilan')
                    ->schema([
                        TextInput::make('order')
                            ->label('Urutan Tampil')
                            ->numeric()
                            ->default(0)
                            ->minValue(0)
                            ->helperText('Angka lebih kecil akan tampil lebih dulu'),

                        Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true)
                            ->helperText('Nonaktifkan untuk menyembunyikan dari tampilan'),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
            ]);
    }
}
