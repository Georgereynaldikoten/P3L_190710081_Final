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
        Schema::create('memberships', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('id_member')->references('id')->on('members');
            $table->string('status_membership');
            $table->date('membership_start_date');
            $table->date('membership_end_date');
            $table->string('membership_fee');
            $table->string('membership_payment_method');
            $table->string('membership_payment_status');
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
        Schema::dropIfExists('memberships');
    }
};
