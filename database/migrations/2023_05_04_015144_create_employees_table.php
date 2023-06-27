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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_role')->references('id')->on('roles');
            $table->foreignId('id_user')->references('id')->on('users');
            $table->string('employee_name');
            $table->string('employee_address');
            $table->enum('employee_gender', ['pria', 'wanita']);
            $table->date('employee_birth_date');
            $table->string('employee_phone_number');
            $table->string('employee_email');
            $table->string('employee_password');

            
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
        Schema::dropIfExists('employees');
    }
};
