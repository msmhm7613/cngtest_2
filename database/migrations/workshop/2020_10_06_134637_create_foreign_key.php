<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('workshops','contractors'))
        Schema::table('workshops', function (Blueprint $table) {

            //$table->engine('InnoDB');
            $table->foreign('contractor_id')
                    ->references('id')
                    ->on('contractors')
                    ->onDelete('NO ACTION')
                    ->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('workshops', function (Blueprint $table) {
            //
        });
    }
}
