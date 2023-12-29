<?php

namespace App\Filament\Resources\LaborFeeExpenseResource\Pages;


use App\Filament\Resources\LaborFeeExpenseResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLaborFeeExpense extends EditRecord
{
    protected static string $resource = LaborFeeExpenseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
