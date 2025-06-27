<?php

namespace App\Filament\User\Resources;

use App\Filament\User\Resources\TransactionHistoryResource\Pages;
use App\Models\Transaction;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ViewColumn;
use Filament\Tables\Columns\BadgeColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class TransactionHistoryResource extends Resource
{
    protected static ?string $model = Transaction::class;
    protected static ?string $navigationIcon = 'heroicon-o-receipt-refund';
    protected static ?string $navigationLabel = 'Transaction History';
    protected static ?string $navigationGroup = 'Akaun Saya';
    

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kelas')->label('Kelas')->searchable()->sortable(),
                TextColumn::make('harga_kelas')->label('Jumlah (RM)')->money('MYR')->sortable(),
                TextColumn::make('status')->label('Status'),
                TextColumn::make('tarikh')->label('Tarikh')->dateTime('d/m/Y H:i')->sortable(),
                ViewColumn::make('bayar')->label('Tindakan')->view('filament.user.resources.transaction-history.bayar-button')
                ,
            ])
            ->filters([])
            ->actions([])
            ->bulkActions([])
            ->defaultSort('created_at', 'desc');
    }

    public static function getEloquentQuery(): Builder
    {
        // Hanya paparkan transaksi user yang sedang login
        return parent::getEloquentQuery()->where('user_id', Auth::id());
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTransactionHistories::route('/'),
        ];
    }
}
