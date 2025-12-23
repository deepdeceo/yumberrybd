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
        Schema::create('partner_payment_methods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('partner_id')->constrained('partners')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // Enums
            $table->enum('time_type', ['weekly', 'day', 'cash_on_delivery']);
            $table->enum('payment_method', ['bkash', 'bank']);

            // Payment details
            $table->json('pay_details')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partner_payment_methods');
    }
};
