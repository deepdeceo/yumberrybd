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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');

            // Ki product/food order kora hoyeche
            $table->foreignId('product_id')->constrained('products');

            $table->integer('quantity'); // Koita order koreche

            // Oi shomoy product-er dam koto chilo (karon pore dam barte/komte pare)
            $table->decimal('unit_price', 10, 2);
            $table->decimal('total_price', 10, 2); // quantity * unit_price
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
