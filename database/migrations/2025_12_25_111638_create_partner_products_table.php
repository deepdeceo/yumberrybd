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
        Schema::create('partner_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('partner_id')->constrained('partners')->onDelete('cascade');
            $table->string('title');
            $table->string('slug')->unique(); // SEO friendly URL er jonno

            // Images
            $table->string('thumbnail'); // Main image
            $table->text('images')->nullable(); // Multiple images (JSON format e save korar jonno)

            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');


            // Discount
            $table->decimal('discount_amount', 10, 2)->nullable();
            $table->enum('discount_type', ['flat', 'percent'])->nullable();

            // Descriptions
            $table->longText('short_description')->nullable();
            $table->longText('long_description')->nullable();

            // Status & Others
            $table->boolean('status')->default(true); // Active or Inactive
            $table->boolean('is_featured')->default(false);
            $table->integer('views')->default(0); // Product popularity track korar jonno

              // Pricing
            $table->decimal('buying_price', 10, 2)->default(0.00);
            $table->decimal('selling_price', 10, 2)->default(0.00);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partner_products');
    }
};
