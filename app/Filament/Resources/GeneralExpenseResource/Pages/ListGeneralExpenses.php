<?php

namespace App\Filament\Resources\GeneralExpenseResource\Pages;

use App\Filament\Resources\GeneralExpenseResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGeneralExpenses extends ListRecords
{
    protected static string $resource = GeneralExpenseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
