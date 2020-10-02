<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PanelController extends Controller
{
    public function index()
    {
        if ( Auth::guest())
            return redirect('/');
        return view('panel');
    }
}
