<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class InsertDefaultUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Insert Default Users Into 'Users' Table.
        if (!Schema::hasTable('users')) {
            return response()->json(['errors' => 'The \'Users\' Table Does NOT Exist.']);
        }


        $roles = [
            1 => ['admin', 'مدیر سایت'],
            2 => ['itman', 'مسئول سایت'],
            3 => ['contractor', 'پیمانکار'],
            4 => ['workshop', 'کارگاه'],
            5 => ['temp-store', 'انبار موقت'],
            6 => ['store', 'انبار'],
        ];

        try {
            foreach ($roles as $key => $value) {
                DB::table('users')->insert([
                    'username'  => $value[0],
                    'password'  => Hash::make('123456789'),
                    'role'      => $key,
                    'title'     => $value[1],
                ]);
            }
            return response()->json(['status' => 'success']);
        } catch (PDOException $ex) {
            return response()->json(['status' => 'failed', 'errors' => $ex]);
        } catch (Exception $ex) {
            return response()->json(['status' => 'failed', 'errors' => $ex]);
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
