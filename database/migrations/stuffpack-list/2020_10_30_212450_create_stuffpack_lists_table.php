<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStuffpackListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stuffpack_lists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stuffpack_id');
            $table->unsignedBigInteger('stuff_id');
            $table->unsignedSmallInteger('stuff_count');
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
        Schema::dropIfExists('stuffpack_lists');
    }
}
