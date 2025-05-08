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
        Schema::create('product_medicine', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->nullOnDelete();
            $table->foreignId('medicine_id')->constrained('category_medicine')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_medicine');
    }
};
