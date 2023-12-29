<?php

namespace App\Filament\Resources\LaborFeeExpenseResource\Pages;

use App\Filament\Resources\LaborFeeExpenseResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLaborFeeExpenses extends ListRecords
{
    protected static string $resource = LaborFeeExpenseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
