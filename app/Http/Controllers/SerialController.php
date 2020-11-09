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
    public function getList(Request $request)
    {
        $rec_id = $request->rec_id;
        try {

            $stuffs = DB::table('temp_reciept_lists')->where('reciept_id','=',$rec_id)
            ->join('stuffs',"stuffs.id","=","temp_reciept_lists.stuff_id")->where('stuffs.has_unique_serial','=','1')
            
            ->get();

            /* $stuffpacks = DB::table('temp_reciept_lists')->where('reciept_id','=',$rec_id)
            ->join('stuffpacks','stuffpacks','=','temp_reciept_lists.stuffpack_id')->where('stuffpacks.has_unique_serial','=','1')
            ->get(); */
            /* 
            $stuffs = TempRecieptList::select('stuff_id')->where('reciept_id',$rec_id)->where('stuff_id','<>','0')->get();
            $stuffs_serials = Stuff::where('id',$stuffs)->where('has_unique_serial','1'); */
            return response()->json(['stuffs' => $stuffs,'rec_id' => $rec_id]);
        } catch (PDOException $ex) {
            return response()->json(['errors' => $ex->errorInfo]);
        }
    }
}
