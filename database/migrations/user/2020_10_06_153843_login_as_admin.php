<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;

class LoginAsAdmin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        if (App\Models\User::where('role', '=', 1)->count() > 0)
            try {
                $admin = App\Models\User::where('role', 1)->first();
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
        //
    }
}
