<?php

namespace App\Filament\User\Resources\TransactionHistoryResource\Pages;

use App\Filament\User\Resources\TransactionHistoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTransactionHistories extends ListRecords
{
    protected static string $resource = TransactionHistoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
