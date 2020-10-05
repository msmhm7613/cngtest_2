<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class kitController extends Controller
{
    public function selectKits(Request $request)
    {
        $all = DB::select('select * from kits');

        return response()->json(['kits'=>$all]);
    }
}
