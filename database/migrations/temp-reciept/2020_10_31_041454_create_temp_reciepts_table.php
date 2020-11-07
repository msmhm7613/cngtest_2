<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempRecieptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_reciepts', function (Blueprint $table) {
            $table->id();
            $table->string('reciept_no');
            $table->string('sender');
            $table->string('referral_number');
            $table->string('referral_date');
            $table->string('driver');
            $table->string('car_no');
            $table->string('car_type');
            $table->string('description')->nullable();
            $table->unsignedBigInteger('creator_id');
            $table->unsignedBigInteger('confirmer_id');
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
        Schema::dropIfExists('temp_reciepts');
    }
}
