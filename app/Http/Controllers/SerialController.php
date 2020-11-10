<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TempReciept;
use App\Models\TempRecieptList;
use Illuminate\Http\Request;
use App\Models\Stuff;
use PDOException;
use Illuminate\Support\Facades\DB;

class SerialController extends Controller
{
     //TODO: فقط رسیدهای دارای کالای سریال دار را انتخاب کنم و دراپ داون فقط اونا رو نشون بده
    public function getList(Request $request)
    {
        $rec_id = $request->rec_id;
        try {

            $stuffs = DB::table('temp_reciept_lists')->where('reciept_id', '=', $rec_id)
                ->join('stuffs', "stuffs.id", "=", "temp_reciept_lists.stuff_id")
                ->where('stuffs.has_unique_serial', '=', '1')
                ->get();// get the number of all stuffs which they need unique serial 

            if ( $stuffs ) // if something exists 

            foreach ($stuffs as $stuff) { // find if this stuff id has been reciept before or not 

                $used = DB::table('serial_lists')
                ->select()
                ->where(
                    'rec_id'            ,"=", "$rec_id",
                    'and' , 'stuff_id'  ,"=", "$stuff->id",
                    //'and' , 'serial'    ,"=", "$stuff->serial"
                    )
                ->count();
                $stuff->used = $used; //? intval($used) : 0 ;
            }
            return response()->json(['stuffs' => $stuffs]);
        } catch (PDOException $ex) {
            return response()->json(['errors' => $ex->errorInfo]);
        }
    }
}
