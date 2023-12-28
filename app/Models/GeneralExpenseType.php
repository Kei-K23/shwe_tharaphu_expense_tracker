<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GeneralExpenseType extends Model
{
    use HasFactory;

    public function generalExpenses(): HasMany
    {
        return $this->hasMany(GeneralExpense::class);
    }
}
