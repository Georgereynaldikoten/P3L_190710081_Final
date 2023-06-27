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
            $table->string('id')->primary();
            $table->foreignId('id_user')->constrained('users');
            $table->string('member_name');
            $table->enum('member_status', ['aktif', 'non-aktif']);
            $table->string('member_address');
            $table->enum('member_gender', ['pria', 'wanita']);
            $table->string('member_phone_number');
            $table->date('member_birth_date');
            $table->string('member_email');
            $table->string('member_password');
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
        Schema::dropIfExists('members');
    }
};
