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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();

            // Add relation to room_type
            $table->unsignedBigInteger('room_type_id');
            $table->foreign('room_type_id')->references('id')->on('room_types')->onDelete('cascade');

            $table->string('room');
            $table->string('status');
            $table->string('cleaning_status')->nullable();
            $table->integer('pax')->nullable();
            $table->string('ext_number')->nullable();
            $table->integer('cleaning_time')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->dropForeign(['room_type_id']);
        });
        Schema::dropIfExists('rooms');
    }
};
