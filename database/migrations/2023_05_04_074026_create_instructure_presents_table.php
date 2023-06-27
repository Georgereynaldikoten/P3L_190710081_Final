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
        Schema::create('instructure_presents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_timetable')->constrained('timetables');
            $table->string('instructure_present_status');
            $table->date('instructure_present_date');
            $table->string('instructure_present_time')->nullable();
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
        Schema::dropIfExists('instructure_presents');
    }
};
