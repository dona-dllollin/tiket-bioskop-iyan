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
            $table->string('order_number')->unique();
            $table->string('booking_code')->unique(); // Diawali dengan "BK"
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('movie_schedule_id')->constrained()->onDelete('cascade');
            $table->string('customer_name');
            $table->integer('number_of_tickets');
            $table->decimal('total_price', 10, 2);
            $table->enum('status', ['pending', 'paid', 'cancelled'])->default('pending');
            $table->timestamps();
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
