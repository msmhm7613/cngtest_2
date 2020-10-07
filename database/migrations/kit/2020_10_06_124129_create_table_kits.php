<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableKits extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
               //Create Kits Table
               Schema::create('kits', function (Blueprint $table) {
                $table->id();
                $table->string('serial')->unique();
                $table->tinyInteger('status');
                $table->tinyInteger('pack_status');
                $table->string('description');
                $table->integer('user_id');
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
        Schema::dropIfExists('table_kits');
    }
}
