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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('category_id')->nullable()->constrained('product_categories')->nullOnDelete();
            $table->foreignId('dose_form_id')->nullable()->constrained('dose_forms')->nullOnDelete();
            $table->string('name');
            $table->string('slug')->nullable();
            $table->unsignedTinyInteger('pack_size')->default(1);
            $table->string('item_code')->nullable();
            $table->text('description')->nullable();
            $table->string('status')->default(ActiveStatus::Active->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
