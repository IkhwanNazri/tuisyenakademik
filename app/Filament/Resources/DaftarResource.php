<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DaftarResource\Pages;
use App\Filament\Resources\DaftarResource\RelationManagers;
use App\Models\Daftar;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DaftarResource extends Resource
{
    protected static ?string $model = Daftar::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-plus';
    protected static ?string $navigationLabel = 'Pendaftaran';
    protected static ?string $navigationGroup = 'Pelajar';
    public static function getNavigationBadge(): ?string
    {
        return Daftar::count();
    }
        public static function getNavigationBadgeColor(): ?string
    {
        return 'info';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('student_name')->label('Nama Pelajar'),
                TextColumn::make('mykid')->label('MyKID'),
                TextColumn::make('birth_date')->label('Tarikh Lahir'),
                TextColumn::make('guardian_first_name')->label('Penjaga'),
                TextColumn::make('guardian_email')->label('Email Penjaga'),
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
            'index' => Pages\ListDaftars::route('/'),
            'create' => Pages\CreateDaftar::route('/create'),
            'edit' => Pages\EditDaftar::route('/{record}/edit'),
        ];
    }
}
