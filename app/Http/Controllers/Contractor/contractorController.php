<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class contractorController extends Controller
{
    public function index(Request $request)
    {
        # code...
    }

    public function loadInsertForm(Request $request)
    {
        return view('layouts.modals.contractor.insert',['r' => $request->r]);
    }
}
