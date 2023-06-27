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
        Schema::create('instructures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->references('id')->on('users');
            $table->string('instructure_name');
            $table->string('instructure_email');
            $table->string('instructure_password');
            $table->string('instructure_phone_number');
            $table->string('instructure_address');
            $table->string('instructure_sex');
            $table->string('count_instructure_present');
            $table->string('count_instructure_absent');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instructures');
    }
};
