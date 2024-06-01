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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('product_categories');
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description');

            // Variant
            $table->enum('variant', ['hot', 'ice', 'both'])->default('both');

            // Hot
            $table->decimal('priceHot', 15, 0)->nullable();
            $table->integer('stockHot')->nullable();
            $table->string('imageHot')->nullable();

            // Ice
            $table->decimal('priceIce', 15, 0)->nullable();
            $table->integer('stockIce')->nullable();
            $table->string('imageIce')->nullable();

            // Supply
            $table->integer('supply')->nullable();

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
