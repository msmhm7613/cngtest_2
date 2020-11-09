<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDOException;
use ErrorException;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class SerialListController extends Controller
{
    public function insert(Request $request)
    {
        $serial_list = json_decode($request->serialList);
        foreach ($serial_list as $itemKey => $itemVal) {
            $x = explode('-', $itemKey);
            $st_id = $x[0];
            $rec_id = $x[2];
            $ser = $itemVal;

            $res = DB::table('serial_lists')->where('stuff_id', '=', $st_id, 'and', 'rec_id', '=', $rec_id, 'and', 'serial', '=', $ser)->count();
            if ($res === 0) {
                try {
                    $newSerialList = new \App\Models\SerialList();


                    $newSerialList->stuff_id = $x[0];
                    $newSerialList->rec_id = $x[2];
                    $newSerialList->serial = $itemVal;

                    $newSerialList->save();
                } catch (PDOException $ex) {
                    response()->json(['errors' => $ex->errorInfo, 'serial list' => $serial_list]);
                }
            }
        }
        return response()->json(['status'=>'ok' ]);
    }
}
