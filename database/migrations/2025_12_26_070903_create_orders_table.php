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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->string('total_price')->nullable();
            $table->string('profit_commission')->nullable();

            $table->integer('quantity')->default(1);

            // Price-er khetre Decimal use kora math calculation-er jonno bhalo
            $table->decimal('total_price', 10, 2);
            $table->decimal('profit_commission', 10, 2)->nullable();
            $table->decimal('delivery_charge', 8, 2)->default(0);

            $table->text('delivery_address');
            $table->string('contact_number')->nullable(); // Emergency contact

            // Order Status
            $table->enum('status', ['pending', 'processing', 'completed', 'cancelled'])->default('pending');

            // Payment Info
            $table->string('payment_method')->default('cod'); // cod, bkash, sslcommerz
            $table->enum('payment_status', ['pending', 'paid', 'failed'])->default('pending');

            $table->foreignId('rider_id')->nullable()->constrained('users'); // Delivery person
            $table->text('order_notes')->nullable(); // User instructions like "Don't ring the bell"

            $table->string('otp')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
