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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('room_id')->constrained('rooms')->cascadeOnDelete();
            $table->json('packet_ids')->nullable();
            $table->timestamp('start_time'); // Kolom untuk waktu mulai
            $table->timestamp('end_time')->nullable(); // Kolom untuk waktu selesai
            $table->decimal('total_payment', 10, 2); // Tambahan untuk total pembayaran
            $table->enum('payment_method', ['cash', 'credit_card', 'bank_transfer']);
            $table->enum('status', ['pending', 'confirmed', 'cancelled', 'completed'])->default('pending');
            $table->timestamps(); // Untuk created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
