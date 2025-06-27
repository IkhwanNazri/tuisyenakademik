<?php

namespace App\Filament\Resources\PelajarResource\Pages;

use App\Filament\Resources\PelajarResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPelajar extends EditRecord
{
    protected static string $resource = PelajarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
} 