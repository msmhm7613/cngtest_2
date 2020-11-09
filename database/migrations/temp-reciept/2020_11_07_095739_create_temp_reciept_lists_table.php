<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempRecieptListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_reciept_lists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reciept_id');
            $table->unsignedBigInteger('stuffpack_id')->nullable();
            $table->unsignedBigInteger('stuff_id')->nullable();
            $table->unsignedMediumInteger('count')->min(1);
            $table->string('comment')->nullable();
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
        Schema::dropIfExists('temp_reciept_lists');
    }
}
