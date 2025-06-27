<?php

namespace App\Filament\User\Resources\PersonalDetailResource\Pages;

use App\Filament\User\Resources\PersonalDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPersonalDetails extends ListRecords
{
    protected static string $resource = PersonalDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
