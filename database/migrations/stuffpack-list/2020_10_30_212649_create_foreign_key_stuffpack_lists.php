<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForeignKeyStuffpackLists extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('stuffpacks','stuffpack_lists','stuffs'))
        Schema::table('stuffpack_lists', function (Blueprint $table) {

            //$table->engine('InnoDB');

            $table  ->foreign('stuffpack_id')
                    ->references('id')
                    ->on('stuffpacks')
                    ->onDelete('CASCADE')
                    ->onUpdate('CASCADE');

            $table  ->foreign('stuff_id')
                    ->references('id')
                    ->on('stuffs')
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
        Schema::dropIfExists('foreign_key_stuffpack_lists');
    }
}
