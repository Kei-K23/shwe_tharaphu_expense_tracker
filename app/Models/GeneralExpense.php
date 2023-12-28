<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GeneralExpense extends Model
{
    use HasFactory;

    public function generalExpenseType(): BelongsTo
    {
        return $this->belongsTo(GeneralExpenseType::class);
    }
}
