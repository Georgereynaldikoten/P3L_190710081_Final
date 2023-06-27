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
        Schema::create('member_presents', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('id_member')->references('id')->on('members');
            $table->foreignId('id_present_instructure')->references('id')->on('instructure_presents')->nullable();
            $table->foreignId('id_gym')->references('id')->on('gyms')->nullable();
            $table->foreignId('id_timetable')->references('id')->on('timetables')->nullable();
            $table->string('id_membership')->references('id')->on('memberships')->nullable();
            $table->string('id_deposit')->references('id')->on('deposits')->nullable();
            $table->string('present_status');
            $table->date('present_date');
            $table->string('present_time')->nullable();
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
        Schema::dropIfExists('member_presents');
    }
};
