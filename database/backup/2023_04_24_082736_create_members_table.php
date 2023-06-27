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
        Schema::create('members', function (Blueprint $table) {
            $table->string->id();
            $table->string('id_user')->references('id')->on('users');
            $table->string('status_member');
            $table->string('member_name');
            $table->string('member_address');
            $table->string('member_sex');
            $table->string('member_phone_number');
            $table->string('member_email');
            $table->string('member_password');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
};
