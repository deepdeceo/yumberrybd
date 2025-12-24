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
            $table->foreignId('user_id')->constrained('admin_panels')->onDelete('cascade');
            $table->string('title');
            $table->string('slug')->unique(); // SEO friendly URL er jonno

            // Images
            $table->string('thumbnail'); // Main image
            $table->text('images')->nullable(); // Multiple images (JSON format e save korar jonno)

            // Relationships
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');

            // Pricing
            $table->decimal('buying_price', 10, 2)->default(0.00);
            $table->decimal('selling_price', 10, 2)->default(0.00);

            // Discount
            $table->decimal('discount_amount', 10, 2)->nullable();
            $table->enum('discount_type', ['flat', 'percent'])->nullable();

            // Inventory
            $table->integer('qty')->default(0);
            $table->string('sku')->unique()->nullable(); // Stock Keeping Unit

            // Descriptions
            $table->longText('short_description')->nullable();
            $table->longText('long_description')->nullable();

            $table->json('cities_id')->nullable();
            $table->json('zones_id')->nullable();

            // Status & Others
            $table->boolean('status')->default(true); // Active or Inactive
            $table->boolean('is_featured')->default(false);
            $table->integer('views')->default(0); // Product popularity track korar jonno
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
