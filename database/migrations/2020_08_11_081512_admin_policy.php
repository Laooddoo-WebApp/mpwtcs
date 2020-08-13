<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AdminPolicy extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adminPolicy', function (Blueprint $table) {
            $table->bigIncrements('PID');
            $table->string('name')->unique();
            $table->integer('userLockTime')->nullable();
            $table->integer('invalidAttemptsAllowed')->nullable();
            $table->integer('otpValidTimeInSeconds')->nullable();
            $table->integer('passwordResetTime')->nullable();
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
        Schema::dropIfExists('adminPolicy');
    }
}
