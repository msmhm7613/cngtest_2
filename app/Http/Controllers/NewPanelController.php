<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewPanelController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user())
            return view('new-panel');
        else
            return view('auth.login');
    }

    public function getContent(Request $request)
    {

        $target = $request->target;
        switch ($target) {
            case 'dashboard':
                return view('contents.dashboard');
                break;
            case 'users':
                return view('layouts.tables.users');
                break;
            case 'store':
                return view('store.table');
                break;
            case 'stuff':
                return view('stuff.table');
                break;
            case 'stuff-pack':
                return view('stuff-pack.table');
                break;
            case 'stuff-file':
                return view('stuff.file-upload');
                break;
            default:
                return 'sorry I couldn\'t find that.';
                break;
        }
    }
}
