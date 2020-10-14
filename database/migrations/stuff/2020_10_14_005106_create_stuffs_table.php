<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStuffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stuffs', function (Blueprint $table) {
            $table->id();
            $table->string('code')->require()->uniqid();
            $table->string('name')->require();
            $table->string('latin_name');
            $table->boolean('has_unique_serial')->default(false);
            $table->unsignedBigInteger('unit_id')->default(1);
            $table->string('description')->nullable();
            $table->unsignedBigInteger('creator_user_id')->require();
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
        Schema::dropIfExists('stuffs');
    }
}
