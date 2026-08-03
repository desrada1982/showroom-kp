<?php

namespace App\Filament\Resources\Transactions\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TransactionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('motor_id')
                    ->required()
                    ->numeric(),
                TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                DatePicker::make('tanggal_terjual')
                    ->required(),
                TextInput::make('harga_deal')
                    ->required()
                    ->numeric(),
                TextInput::make('laba_bersih')
                    ->required()
                    ->numeric(),
            ]);
    }
}
