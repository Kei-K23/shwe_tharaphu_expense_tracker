<?php

namespace App\Filament\Resources\PurchasingExpenseResource\Pages;

use App\Filament\Resources\PurchasingExpenseResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPurchasingExpense extends EditRecord
{
    protected static string $resource = PurchasingExpenseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
