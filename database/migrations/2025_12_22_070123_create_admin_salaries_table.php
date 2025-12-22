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
        Schema::create('admin_salaries', function (Blueprint $table) {
            $table->id();
            // Link to admin/user table
            $table->foreignId('user_id')
                ->constrained('admin_panels')   // references 'users.id'
                ->cascadeOnDelete();     // delete salary if user deleted

            // Salary components
            $table->decimal('basic', 10, 2)->default(0);      // base salary
            $table->decimal('bonus', 10, 2)->nullable();      // bonus
            $table->decimal('allowance', 10, 2)->nullable();  // allowances
            $table->decimal('deduction', 10, 2)->nullable();  // deductions
            $table->decimal('net_salary', 10, 2)->nullable(); // calculated net salary
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_salaries');
    }
};
