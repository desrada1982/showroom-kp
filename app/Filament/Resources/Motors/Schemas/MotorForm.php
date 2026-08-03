<?php

namespace App\Filament\Resources\Motors\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class MotorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('merk')
                    ->required(),
                TextInput::make('tipe')
                    ->required(),
                TextInput::make('tahun')
                    ->required()
                    ->numeric(),
                TextInput::make('plat_nomor')
                    ->required(),
                TextInput::make('kilometer')
                    ->required()
                    ->numeric(),
                TextInput::make('status_surat')
                    ->required(),
                Textarea::make('catatan')
                    ->columnSpanFull(),
                TextInput::make('harga_beli')
                    ->required()
                    ->numeric(),
                TextInput::make('biaya_rekondisi')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('harga_jual')
                    ->required()
                    ->numeric(),
                TextInput::make('foto_utama'),
                Select::make('status')
                    ->options(['Tersedia' => 'Tersedia', 'Terjual' => 'Terjual'])
                    ->default('Tersedia')
                    ->required(),
            ]);
    }
}
