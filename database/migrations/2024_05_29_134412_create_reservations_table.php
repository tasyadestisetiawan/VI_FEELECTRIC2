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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name')->nullable();
            $table->date('check_in');
            $table->date('check_out')->nullable();
            $table->time('check_in_time');
            $table->time('check_out_time');
            $table->integer('total_guests');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('special_request')->nullable();
            $table->decimal('amount', 10, 0)->nullable();
            $table->enum('payment_method', ['cash', 'transfer'])->default('cash');
            $table->string('payment_proof')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
