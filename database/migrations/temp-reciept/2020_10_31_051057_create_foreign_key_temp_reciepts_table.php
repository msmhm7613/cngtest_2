<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForeignKeyTempRecieptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('stuffpacks','temp_reciepts'))
        Schema::table('temp_reciepts', function (Blueprint $table) {

            //$table->engine('InnoDB');

            $table  ->foreign('stuffpack_id')
                    ->references('id')
                    ->on('stuffpacks')
                    ->onDelete('RESTRICT')
                    ->onUpdate('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('foreign_key_temp_reciepts');
    }
}
