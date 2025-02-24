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
        Schema::create('success_rates', function (Blueprint $table) {
            $table->id();
            $table->string('rate_count_eng', 20);
            $table->string('rate_count_mm', 20);
            $table->string('description_eng');
            $table->string('description_mm');
            $table->integer('order_number');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('success_rates');
    }
};
