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
        Schema::create('room_types', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('room_type');
            $table->string('description')->nullable();
            $table->integer('base_occupancy');
            $table->integer('max_occupancy');
            $table->integer('base_occupancy_kid');
            $table->integer('max_occupancy_kid');
            $table->integer('base_price');
            $table->integer('extra_adult_price');
            $table->integer('extra_kid_price');
            $table->integer('base_availability');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_types');
    }
};
