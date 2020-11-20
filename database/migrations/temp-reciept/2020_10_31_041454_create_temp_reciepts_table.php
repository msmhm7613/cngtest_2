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
            $table->string('reciept_no',30);
            $table->string('sender',30);
            $table->string('referral_number',30);
            $table->string('referral_date',30);
            $table->string('driver',30);
            $table->string('car_no',30);
            $table->string('car_type',30);
            $table->string('description',255)->nullable();
            $table->unsignedBigInteger('creator_id');
            $table->unsignedBigInteger('confirmer_id');
            $table->unsignedBigInteger('tempstore_id')->default(1);
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
