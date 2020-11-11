<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class InsertPrimaryUnits extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('units')) {
            $primary_units = [
                ['عدد', 'No'],
                ['کیلوگرم', 'Kg'],
                ['گرم', 'g'],
                ['متر', 'm'],
                ['سانتیمتر', 'cm'],
                ['میلیمتر', 'mm'],
                ['لیتر', 'l'],
                ['میلی لیتر', 'ml'],
                ['متر مربع', 'm2'],
                ['سانتیمتر مربع', 'cm2'],
                ['متر مکعب', 'm3'],
                ['بشکه', 'barrel'],
                ['بسته', 'pack'],
                ['پاکت', 'packet'],
                ['جعبه', 'box'],
                ['شیرینگ', '-'],
                ['قوطی', '-'],
                ['دستگاه', '-'],
            ];

            foreach ( $primary_units as $unit)
            {
                DB::insert('insert into units (name,code,creator_user_id,description) values (?, ?, ?, ?)', [$unit[0], $unit[1],1,'-']);
            }
        }
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
