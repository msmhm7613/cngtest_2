<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class \store\createStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $table->id();
        $table->string('name')          ->uniqid();
        $table->string('manager')       ->default('---');
        $table->string('code')          ->uniqid()->default('---');
        $table->string('phone')         ->default('---');
        $table->string('mobile')        ->default('---');
        $table->string('address')       ->default('---');
        $table->string('description')   ->default('---');
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
        //
    }
}
