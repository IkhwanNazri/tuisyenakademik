<?php

namespace App\Filament\Pages;

use App\Models\Kehadiran;
use Filament\Pages\Page;
use Filament\Tables\Table;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

// pelajar_id','tarikh','masa'

class Kedatangan extends Page implements HasTable
{
    use InteractsWithTable;
    protected static ?string $navigationIcon = 'heroicon-o-clipboard';
    protected static ?string $navigationLabel = 'Rekod Kehadiran';
    protected static ?string $navigationGroup = 'Kedatangan';
    // protected static ?string $title = 'R';
    protected static string $view = 'filament.pages.kedatangan';
    public function table(Table $table): Table
    {
        return $table
            ->query(Kehadiran::query())
            ->columns([
                TextColumn::make('id')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('pelajar.nama')
                    ->label('Nama Pelajar')
                    ->searchable()
                    ->sortable()
                    ->wrap(),
                TextColumn::make('pelajar.kelas')
                    ->label('Kelas')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('tarikh')
                    ->date()
                    ->sortable(),
                TextColumn::make('masa')
                    ->time()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->paginated([10, 25, 50, 100])
            ->contentGrid([
                'md' => 2,
                'lg' => 3,
                'xl' => 4,
            ])
            ->filters([
                // Add any filters you need
            ])
            ->actions([
                // Add any actions you need
            ])
            ->bulkActions([
                // Add any bulk actions you need
            ]);
    }
}


