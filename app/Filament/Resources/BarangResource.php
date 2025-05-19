<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BarangResource\Pages;
use App\Filament\Resources\BarangResource\RelationManagers;
use App\Models\Barang;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BarangResource extends Resource
{
    protected static ?string $model = Barang::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Forms\Components\TextInput::make('nama_barang')
                //     ->required()
                //     ->maxLength(255),

                Forms\Components\Select::make('tipe_papan_bunga')
                    ->options([
                        'ucapan selamat' => 'Ucapan Selamat',
                        'duka cita' => 'Duka Cita',
                        'pernikahan' => 'Pernikahan',
                        'sunat rasul' => 'Sunat Rasul',
                    ])
                    ->required(),

                Forms\Components\Select::make('ukuran_papan_bunga')
                    ->options([
                        'kecil' => 'Kecil',
                        'sedang' => 'Sedang',
                        'besar' => 'Besar',
                    ])
                    ->required(),

                Forms\Components\Select::make('status')
                    ->options([
                        'bayar' => 'Bayar',
                        'belum bayar' => 'Belum Bayar',
                    ])
                    ->default('belum bayar')
                    ->required(),

                Forms\Components\TextInput::make('harga')
                    ->numeric()
                    ->prefix('Rp')
                    ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Tables\Columns\TextColumn::make('nama_barang')
                //     ->searchable()
                //     ->sortable(),

                Tables\Columns\TextColumn::make('tipe_papan_bunga')
                    ->badge()
                    ->sortable(),

                Tables\Columns\TextColumn::make('ukuran')
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'success' => 'bayar',
                        'danger' => 'belum bayar',
                    ])
                    ->sortable(),

                Tables\Columns\TextColumn::make('harga')
                    ->money('IDR', true)
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBarangs::route('/'),
            'create' => Pages\CreateBarang::route('/create'),
            'edit' => Pages\EditBarang::route('/{record}/edit'),
        ];
    }
}
