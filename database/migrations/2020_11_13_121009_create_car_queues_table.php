<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarQueuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_queues', function (Blueprint $table) {
            $table->id();
            $table->text('track_number');
            $table->string('turn_date',20);
            $table->string('status',20);
            $table->string('owner_name',255);
            $table->string('owner_id',14);
            $table->string('owner_phone',20);
            $table->string('tag',155);
            $table->string('car_type',155);
            $table->string('car_brand',155);
            $table->string('car_model',155);
            $table->string('state',55);
            $table->string('city',55);
            $table->string('contractor',255);
            $table->string('workshop',255);
            $table->string('workshop_state',55);
            $table->string('workshop_city',55);
            $table->Text('workshop_address');
            $table->string('workshop_phone');
            $table->string('convert_date',20)->nullable();
            $table->string('convert_id',255)->nullable();
            $table->string('tank_size',255)->nullable();
            $table->string('tank_id',255)->nullable();
            $table->string('tank_valve',255)->nullable();
            $table->string('regulator_id',255)->nullable();
            $table->string('convert_certificate_id',255)->nullable();
            $table->string('health_certificate_id',255)->nullable();
            $table->string('engine_id',255)->nullable();
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
        Schema::dropIfExists('car_queues');
    }
}
