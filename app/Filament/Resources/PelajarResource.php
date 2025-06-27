<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PelajarResource\Pages;
use App\Models\Pelajar;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PelajarResource extends Resource
{
    protected static ?string $model = Pelajar::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationLabel = 'Senarai Pelajar';
    protected static ?string $navigationGroup = 'Pelajar';

    protected static ?string $modelLabel = 'Pelajar';

    protected static ?string $pluralModelLabel = 'Pelajar';
    public static function getNavigationBadge(): ?string
    {
        return Pelajar::count();
    }
        public static function getNavigationBadgeColor(): ?string
    {
        return 'gray';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->label('Nama Pelajar')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('kelas')
                    ->label('Kelas')
                    ->maxLength(255),
                Forms\Components\TextInput::make('darjah')
                    ->label('Darjah')
                    ->maxLength(255),
                Forms\Components\Select::make('daftar_id')
                    ->label('ID Daftar')
                    ->relationship('daftar', 'student_name')
                    ->searchable()
                    ->preload(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama Pelajar')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('darjah')
                    ->label('Darjah')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('kelas')
                    ->label('Kelas')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('daftar.student_name')
                    ->label('Nama dari Daftar')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tarikh Daftar')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\Action::make('lihat_qr')
              
                ->label('Lihat QR')
                ->icon('heroicon-o-qr-code')
                ->url(fn (Pelajar $record): string => route('pelajar.qr', ['pelajar' => $record->id]))
                ->openUrlInNewTab(),
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
            'index' => Pages\ListPelajars::route('/'),
            'create' => Pages\CreatePelajar::route('/create'),
            'edit' => Pages\EditPelajar::route('/{record}/edit'),
        ];
    }
} 