<?php

namespace App\Filament\Resources\LabourFeeExpenseResource\Pages;

use App\Filament\Resources\LabourFeeExpenseResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLabourFeeExpenses extends ListRecords
{
    protected static string $resource = LabourFeeExpenseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
