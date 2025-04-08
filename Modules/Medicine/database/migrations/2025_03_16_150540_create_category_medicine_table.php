<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Medicine\Enums\ActiveStatus;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // TODO: 1 MEDICINE HAS 1 ATC CODE
        Schema::create('category_medicine', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('medicine_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('dose_form_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('atc_id')->nullable()->constrained()->nullOnDelete();
            $table->string('status')->default(ActiveStatus::Active->value);
            $table->string('strength')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_medicine');
    }
};
