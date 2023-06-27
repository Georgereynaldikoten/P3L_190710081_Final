<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('id_member')->references('id')->on('members')->nullable();
            $table->foreignId('id_class')->references('id')->on('clasess')->nullable();
            $table->foreignId('id_gym')->references('id')->on('gyms')->nullable();
            $table->date('booking_date');
            $table->string('booking_time');
            $table->string('booking_status');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
};
