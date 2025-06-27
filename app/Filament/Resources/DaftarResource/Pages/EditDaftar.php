<?php

namespace App\Filament\Resources\DaftarResource\Pages;

use App\Filament\Resources\DaftarResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDaftar extends EditRecord
{
    protected static string $resource = DaftarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
