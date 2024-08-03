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
        Schema::create('guests', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('lastname');
            $table->string('second_lastname')->nullable();
            $table->string('birthdate')->nullable();
            $table->string('gender')->nullable();
            $table->string('nationality')->default('mexican')->nullable();
            $table->string('phone')->nullable();
            $table->string('fax')->nullable();
            $table->string('email')->nullable();
            $table->string('client_id')->nullable();
            $table->string('address')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('id_document')->nullable();
            $table->string('no_id_document')->nullable();
            $table->string('occupation')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guests');
    }
};
