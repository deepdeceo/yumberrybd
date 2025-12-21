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
        Schema::create('user_ip_infos', function (Blueprint $table) {
            $table->id();
            // IP ebong basic info
            $table->string('ip_address')->nullable();
            $table->string('country_name')->nullable();
            $table->string('country_code')->nullable();
            $table->string('region_name')->nullable(); // State ba Division
            $table->string('city_name')->nullable();
            $table->string('zip_code')->nullable();

            // Coordinates (Map-e dekhate lagbe)
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();

            // Additional info
            $table->string('timezone')->nullable();
            $table->string('isp')->nullable(); // Internet Service Provider
            $table->string('browser')->nullable(); // Browser details
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_ip_infos');
    }
};
