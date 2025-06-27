<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\Kehadiran;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Builder;

class HadirPage extends Page implements HasTable
{
    use InteractsWithTable;
    
    protected static ?string $navigationIcon = 'heroicon-o-camera';
    protected static ?string $navigationLabel = 'Scan Disini';
    protected static ?string $navigationGroup = 'Kedatangan';
    protected static ?string $title = 'Rekod Kehadiran';
    
    protected static string $view = 'filament.pages.hadir-page';
    
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
