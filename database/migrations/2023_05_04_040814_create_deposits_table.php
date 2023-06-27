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
        Schema::create('deposits', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('id_member')->references('id')->on('members');
            $table->foreignId('id_class')->references('id')->on('clasess');
            $table->foreignId('id_promo')->references('id')->on('promos')->nullable();
            $table->enum('deposit_type', ['reguler', 'paket']);
            $table->date('deposit_date');
            $table->integer('deposit_amount');
            $table->integer('deposit_bonus')->nullable();
            $table->integer('deposit_remaining');
            $table->integer('deposit_total');
            $table->date('deposit_expired_date')->nullable();
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
        Schema::dropIfExists('deposits');
    }
};
