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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id');
            $table->integer('quantity');
            $table->decimal('price', 10, 0);

            // Variants
            $table->string('size')->nullable();
            $table->string('temperature')->nullable();
            $table->string('type')->nullable();

            // Notes
            $table->text('notes')->nullable();

            // Total Price
            $table->decimal('total_price', 10, 0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};