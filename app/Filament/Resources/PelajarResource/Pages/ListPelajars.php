<?php

namespace App\Filament\Resources\PelajarResource\Pages;

use App\Filament\Resources\PelajarResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPelajars extends ListRecords
{
    protected static string $resource = PelajarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
} 