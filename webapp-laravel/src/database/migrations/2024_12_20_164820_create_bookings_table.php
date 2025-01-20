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
        Schema::dropIfExists('bookings');
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('booking_code');
            $table->unique('booking_code');
            $table->foreignId('from')->references('id')->on('airports');
            $table->foreignId('to')->references('id')->on('airports');
            $table->date('departure');
            $table->string('name');
            $table->string('email');
            $table->string('address');
            $table->string('city');
            $table->string('country');
            $table->double('amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
