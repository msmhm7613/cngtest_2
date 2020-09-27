<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InstallController extends Controller
{
    public function index ()
    {
        $db_status = env('DB_INSTALLED',0);
        if ( !$db_status )
            return view ( 'install' );
        return view('welcome')->with('db',$db_status);
    }
}
