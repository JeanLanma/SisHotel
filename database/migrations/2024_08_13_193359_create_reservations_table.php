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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();

            $table->string('serie')->default('A');
            $table->string('folio')->nullable();
            $table->string('guests_name');
            $table->dateTime('checkin');
            $table->dateTime('checkout');
            $table->string('arrival_time');
            $table->string('status')->default('pending');
            $table->dateTime('expiration_date')->nullable();
            $table->integer('adults')->default(1);
            $table->integer('kids')->default(0);
            $table->string('person_booking_name');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->text('observations')->nullable();
            // walking_in | web | phone | email
            $table->string('reservation_type')->default('walking_in')->nullable();
            $table->integer('rooms')->nullable();
            $table->unsignedBigInteger('room_type_id');
            $table->unsignedBigInteger('room_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('shift')->nullable();
            $table->unsignedBigInteger('guests_id')->nullable();
            $table->decimal('total')->default('0.0000')->nullable();
            $table->string('tax_free_account')->nullable();
            $table->integer('mail_sent')->default(0)->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
