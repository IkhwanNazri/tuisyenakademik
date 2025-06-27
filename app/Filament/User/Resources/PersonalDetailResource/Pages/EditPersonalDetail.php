<?php

namespace App\Filament\User\Resources\PersonalDetailResource\Pages;

use App\Filament\User\Resources\PersonalDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPersonalDetail extends EditRecord
{
    protected static string $resource = PersonalDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
