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
        Schema::create('partners', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['shop', 'restaurant', 'pharmacy', 'grocery']);
            $table->foreignId('cities')->constrained('cities')->onDelete('cascade');
            $table->foreignId('zones_id')->constrained('zones')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->enum('branch', ['main', 'sub'])->default('main');
            $table->string('total_branch')->nullable();
            $table->string('business_name')->nullable();
            $table->text('business_address')->nullable();
            $table->json('opening_hours')->nullable();
            $table->decimal('minimum_order', 8, 2)->default(0);
            $table->string('business_number')->nullable();
            $table->string('logo')->nullable();
            $table->string('banner')->nullable();
            $table->json('cuisines')->nullable();
            $table->boolean('isActive')->default(true);
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->boolean('is_open')->default(true);
            $table->timestamp('last_online_at')->nullable();
            $table->integer('avg_preparation_time')->default(15);
            $table->boolean('is_verified')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partners');
    }
};
