<?php

namespace App\Filament\Resources\PurchasingExpenseResource\Pages;

use App\Filament\Resources\PurchasingExpenseResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePurchasingExpense extends CreateRecord
{
    protected static string $resource = PurchasingExpenseResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
