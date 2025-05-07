<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PembayaranResource\Pages;
use App\Filament\Resources\PembayaranResource\RelationManagers;
use App\Models\Pembayaran;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;

class PembayaranResource extends Resource
{
    protected static ?string $model = Pembayaran::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('pelanggan_id')
                ->relationship('pelanggan', 'nama_pelanggan')
                ->required(),
                Forms\Components\Select::make('barang_id')
                    ->relationship('barang', 'tipe_papan_bunga')
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\Select::make('pesanan_id')
                    ->relationship('pesanan', 'jumlah')
                    ->required(),
                Forms\Components\DatePicker::make('tanggal_bayar')
                    ->required(),
                Forms\Components\DatePicker::make('tanggal_pegantaran')
                    ->required(),
                Forms\Components\TextInput::make('keterangan')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('pelanggan.nama_pelanggan')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('barang.tipe_papan_bunga')
                    ->numeric()
                    ->sortable(),
                    TextColumn::make('barang.ukuran_papan_bunga')->label('Ukuran papan bunga')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tanggal_bayar')
                    ->dateTime()
                    ->searchable(),
                Tables\Columns\TextColumn::make('tanggal_pegantaran')
                    ->dateTime()
                    ->searchable(),
                    TextColumn::make('barang.harga')->label('Harga')
                    ->money('IDR', true)
                    ->sortable(),

                    TextColumn::make('barang.status')->label('Status')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('pesanan.jumlah')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('keterangan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
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
            'index' => Pages\ListPembayarans::route('/'),
            'create' => Pages\CreatePembayaran::route('/create'),
            'edit' => Pages\EditPembayaran::route('/{record}/edit'),
        ];
    }
}
