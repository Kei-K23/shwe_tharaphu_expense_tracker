<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('general_expenses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->bigInteger('price');
            $table->longText('description')->nullable();
            $table->foreignId('general_expense_types_id')->constrained('general_expense_types')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('general_expenses');
    }
};
