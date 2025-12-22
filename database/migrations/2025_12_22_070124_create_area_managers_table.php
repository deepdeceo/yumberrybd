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
        Schema::create('area_managers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained('admin_panels')      // references 'users' table
                ->cascadeOnDelete();        // delete area_manager if user deleted

            $table->foreignId('cities_id')
                ->constrained('cities')     // references 'cities' table
                ->cascadeOnDelete();
            $table->unique(['user_id', 'cities_id']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('area_managers');
    }
};
