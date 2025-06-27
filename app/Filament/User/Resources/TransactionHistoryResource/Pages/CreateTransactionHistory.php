<?php

namespace App\Filament\User\Resources\TransactionHistoryResource\Pages;

use App\Filament\User\Resources\TransactionHistoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTransactionHistory extends CreateRecord
{
    protected static string $resource = TransactionHistoryResource::class;
}
