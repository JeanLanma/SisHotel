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
        Schema::create('assigned_rooms', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('room_id');
            $table->unsignedBigInteger('reservation_id');
            $table->unsignedBigInteger('user_id');
            $table->dateTime('checkin');
            $table->dateTime('checkout');
            $table->dateTime('departure_time')->default(null)->nullable();
            $table->string('status')->default('in_house');
            $table->text('observations')->nullable();
            $table->text('items')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assigned_rooms');
    }
};
