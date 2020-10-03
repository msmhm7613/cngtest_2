<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstallController extends Controller
{
    public function index ()
    {
        $db_status = env('DB_INSTALLED',0);
        if ( !$db_status )
            return view ( 'install' );
        elseif (Auth::user())
            return view('panel');
        else
            return view('auth.login');
    }
}
