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
        Schema::create('purchasing_expenses', function (Blueprint $table) {
            $table->id();
            $table->string('item_name');
            $table->integer('quantity')->nullable();
            $table->bigInteger('unit_price')->nullable();
            $table->bigInteger('total_cost');
            $table->longText('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchasing_expenses');
    }
};
