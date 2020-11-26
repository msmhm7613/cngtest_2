<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_inventories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tempstore_id')->default(1);
            $table->integer('count')->default(1);
            $table->integer('stuff_id');
            $table->integer('stuffpack_id');
            $table->integer('creator_id');
            $table->integer('modifier_id');
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
        Schema::dropIfExists('store_inventories');
    }
}
