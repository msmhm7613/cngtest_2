<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableWorkshops extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create Workshops Table
        Schema::create('workshops', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('manager');
            $table->unsignedBigInteger('contractor_id');
            $table->string('phone');
            $table->string('mobile');
            $table->string('address');
            $table->string('description')->default('-');
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
        Schema::dropIfExists('workshops');
    }
}
