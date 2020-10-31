<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStuffpacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stuffpacks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->string('serial');
            $table->string('description')->nullable();
            $table->unsignedBigInteger('creator_user_id');
            $table->unsignedBigInteger('modifier_user_id');
            
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
        Schema::dropIfExists('stuffpacks');
    }
}
