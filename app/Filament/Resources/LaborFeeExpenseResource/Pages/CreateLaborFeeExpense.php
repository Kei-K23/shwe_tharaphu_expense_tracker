<?php

namespace App\Filament\Resources\LaborFeeExpenseResource\Pages;

use App\Filament\Resources\LaborFeeExpenseResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateLaborFeeExpense extends CreateRecord
{
    protected static string $resource = LaborFeeExpenseResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
