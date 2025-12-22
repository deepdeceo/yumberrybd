<?php

use Illuminate\Container\Attributes\DB;
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
        Schema::create('partner_flat_rates', function (Blueprint $table) {
            $table->id();
            $table->string('order_range'); // e.g., "0-400", "401-800", "801+"
            $table->decimal('commission', 8, 2); // fixed commission in taka
            $table->text('notes')->nullable(); // optional notes
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partner_flat_rates');
    }
};
