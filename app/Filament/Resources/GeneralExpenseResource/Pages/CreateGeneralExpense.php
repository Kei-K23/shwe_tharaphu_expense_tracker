<?php

namespace App\Filament\Resources\GeneralExpenseResource\Pages;

use App\Filament\Resources\GeneralExpenseResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateGeneralExpense extends CreateRecord
{
    protected static string $resource = GeneralExpenseResource::class;
}
