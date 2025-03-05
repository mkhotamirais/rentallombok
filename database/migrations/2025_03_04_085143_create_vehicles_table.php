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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('brand_name');
            $table->string('slug')->unique();
            $table->decimal('rental_price', 20, 0)->default(0);
            $table->string('color')->nullable();
            $table->text('policy');
            $table->text('information')->nullable();
            $table->string('banner')->nullable();
            $table->foreignId('vehiclecat_id')->nullable();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
