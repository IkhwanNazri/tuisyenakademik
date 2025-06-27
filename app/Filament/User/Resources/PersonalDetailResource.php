<?php

namespace App\Filament\User\Resources;

use App\Filament\User\Resources\PersonalDetailResource\Pages;
use App\Models\Daftar;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\ViewAction;

class PersonalDetailResource extends Resource
{
    protected static ?string $model = Daftar::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-circle';
    protected static ?string $navigationLabel = 'Personal Details';
    protected static ?string $navigationGroup = 'Akaun Saya';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('student_name')->label('Nama Pelajar'),
                TextColumn::make('mykid')->label('MyKID'),
                TextColumn::make('birth_date')->label('Tarikh Lahir'),
                TextColumn::make('guardian_first_name')->label('Penjaga'),
                TextColumn::make('guardian_email')->label('Email Penjaga'),
                // ... tambah field lain jika mahu
            ])
            ->filters([])
            ->actions([
                ViewAction::make()
                    ->modalHeading('Lihat Maklumat')
                    ->modalSubheading(fn($record) => $record->student_name)
                    ->modalContent(fn($record) => view('filament.user.resources.personal-detail-modal', ['record' => $record]))
            ])
            ->bulkActions([]);
    }

    public static function getEloquentQuery(): Builder
    {
        // Hanya paparkan detail user yang sedang login (berdasarkan email penjaga)
        return parent::getEloquentQuery()->where('guardian_email', Auth::user()->email);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPersonalDetails::route('/'),
        ];
    }
}
