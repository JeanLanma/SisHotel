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
            $table->integer('base_occupancy')->default(0);
            $table->integer('max_occupancy')->nullable();
            $table->integer('base_occupancy_kids')->default(0);
            $table->integer('max_occupancy_kids')->nullable();
            $table->integer('base_price')->default(0);
            $table->integer('extra_adult_price')->nullable();
            $table->integer('extra_kid_price')->nullable();
            $table->integer('base_availability');
            $table->string('status')->default('ok');

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
