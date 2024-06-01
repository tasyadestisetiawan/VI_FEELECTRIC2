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
        Schema::create('orders_histories', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Personal Information
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();

            // Product Information
            $table->json('products');

            // Payment Information
            $table->string('paymentMethod');
            $table->enum('paymentStatus', ['pending', 'paid', 'failed'])->default('pending')->nullable();
            $table->string('paymentReference')->nullable();

            // Order Information
            $table->enum('orderStatus', ['pending', 'processing', 'completed', 'cancelled'])->default('pending');
            $table->text('note')->nullable();
            $table->text('cost')->nullable();
            $table->decimal('subTotal', 10, 0);
            $table->string('type')->nullable();
            $table->integer('quantity')->default(1);

            // Voucher Information
            $table->string('voucherCode')->nullable();
            $table->decimal('voucherDiscount', 10, 0)->default(0);
            $table->decimal('total', 10, 0);

            // Midtrans
            $table->string('snap_token')->nullable();
            $table->string('transaction_status')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders_histories');
    }
};
