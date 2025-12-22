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
        Schema::create('admin_salary_paids', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_salary_id')
                ->constrained('admin_salaries')
                ->cascadeOnDelete();

            $table->date('payment_date');            // date of payment
            $table->decimal('amount', 10, 2)->default(0);  // amount paid
            $table->string('payment_method')->nullable();  // e.g., bank, cash, bKash
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_salary_paids');
    }
};
