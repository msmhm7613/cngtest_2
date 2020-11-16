<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempstoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tempstores', function (Blueprint $table) {
            $table->id();
            $table->string('name',30)          ->unique();
            $table->string('manager',30)       ->default("---");
            $table->string('code',30)          ->unique()->default("---");
            $table->string('phone',30)         ->default("---");
            $table->string('mobile',30)        ->default("---");
            $table->string('address',30)       ->default("---");
            $table->string('description',255)   ->default("---");
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
        Schema::dropIfExists('tempstores');
    }
}
