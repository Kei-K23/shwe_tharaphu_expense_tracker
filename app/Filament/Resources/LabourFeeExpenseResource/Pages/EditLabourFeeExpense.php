<?php

namespace App\Filament\Resources\LabourFeeExpenseResource\Pages;

use App\Filament\Resources\LabourFeeExpenseResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLabourFeeExpense extends EditRecord
{
    protected static string $resource = LabourFeeExpenseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
