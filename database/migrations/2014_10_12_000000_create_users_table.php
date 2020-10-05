<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Create User Table
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->tinyInteger('role');
            $table->string('title');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        $this->insertPrimaryUsers();

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
        Schema::create('contractors', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('description')->default('-');
            $table->integer('user_id');
            $table->timestamps();
        });

        $this->loginAsAdmin();
    }

    /**
     * Login Automatically as an Administrator
     *
     * @return void
     */
    private function loginAsAdmin()
    {
        try {
            $admin = Models\User::where('role', 1)->first();
            Auth::login($admin);
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
        Schema::dropIfExists('users');
    }

    //Insert Primary Users
    /**
     * Insert Primary Users For Database
     *
     * @return void
     */
    private function insertPrimaryUsers()
    {

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
                    'password'  => '123456789',
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
}
