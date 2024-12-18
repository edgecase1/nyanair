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
        Schema::create('airports', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('code');
            $table->string('icao');
            $table->string('name');
            $table->double('latitude');
            $table->double('longitude');
            $table->decimal('elevation');
            $table->string('url');
            $table->string('time_zone');
            $table->string('city_code');
            $table->string('country');
            $table->string('city');
            $table->string('state');
            $table->string('county');
            $table->string('type');
            //$table->foreignId('user)->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('airpots');
    }
};
