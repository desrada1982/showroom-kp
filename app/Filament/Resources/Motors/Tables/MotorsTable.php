<?php

namespace App\Filament\Resources\Motors\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MotorsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('merk')
                    ->searchable(),
                TextColumn::make('tipe')
                    ->searchable(),
                TextColumn::make('tahun')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('plat_nomor')
                    ->searchable(),
                TextColumn::make('kilometer')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('status_surat')
                    ->searchable(),
                TextColumn::make('harga_beli')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('biaya_rekondisi')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('harga_jual')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('foto_utama')
                    ->searchable(),
                TextColumn::make('status')
                    ->badge(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
