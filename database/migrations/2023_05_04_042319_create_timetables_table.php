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
        Schema::create('timetables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_class')->references('id')->on('clasess');
            $table->foreignId('id_instructure')->references('id')->on('instructures');
            $table->string('timetable_type');
            $table->string('timetable_day');
            $table->date('timetable_date');
            $table->string('timetable_time');
            $table->string('timetable_status')->nullable();

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
        Schema::dropIfExists('timetables');
    }
};
