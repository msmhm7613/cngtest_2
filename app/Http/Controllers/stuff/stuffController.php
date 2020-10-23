<?php

namespace App\Http\Controllers\stuff;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PDOException;
use App\Models\Stuff;
use Illuminate\Support\Facades\DB;

class stuffController extends Controller
{

    public function validateStuff(Request $request)
    {
        $rules = [
            'code' => ['string', 'alpha_dash', 'min:3', 'max:64', 'required', 'unique:stuffs,code',],
            'name' => ['string', 'regex:/^[\pL0-9 -_]+$/u', 'min:3', 'max:64', 'required'],
            'latin_name' => ['string', 'regex:/^[a-zA-Z0-9 -_]+$/u', 'min:3', 'max:64', 'nullable'],
            'has_unique_serial' => ['boolean'],
            'creator_user_id' => ['numeric', 'exists:users,id'],
            'description' => ['string', 'max:255', 'nullable'],
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {

            return response()->json(['errors' => $validator->getMessageBag()]);
        }
        return true;
    }

    public function insert(Request $request)
    {
        $rules = [
            'code' => ['string', 'alpha_dash', 'min:3', 'max:64', 'required', 'unique:stuffs,code',],
            'name' => ['string', 'regex:/^[\pL0-9 -_]+$/u', 'min:3', 'max:64', 'required'],
            'latin_name' => ['string', 'regex:/^[a-zA-Z0-9 -_]+$/u', 'min:3', 'max:64', 'nullable'],
            'has_unique_serial' => ['boolean'],
            'creator_user_id' => ['numeric', 'exists:users,id','required'],
            'modifier_user_id' => ['numeric', 'exists:users,id','required'],
            'description' => ['string', 'max:255', 'nullable'],
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {

            return response()->json(['errors' => $validator->getMessageBag()]);
        }

        try {
            $stuff = new Stuff();
            $stuff->code = $request->code; //return response('try');
            $stuff->name = $request->name;
            $stuff->latin_name = $request->latin_name;
            $stuff->creator_user_id = $request->user()->id;
            $stuff->modifier_user_id = $request->user()->id;
            $stuff->has_unique_serial = $request->has_unique_serial;
            $stuff->unit_id = $request->unit_id;
            $stuff->description = $request->description;
            $stuff->save();
            return response('کالا ثبت شد');
        } catch (Exception $ex) {
            return response()->json(['errors' => $ex->getMessage()]);
        }
    }


    /*
        SELECT STUFF FOR EDIT
    */
    public function selectStuff(Request $request)
    {

        try {

            $selected_stuff = DB::table('stuffs')->where('id',[$request->id])->get();//DB::select('select * from stuffs where id = ?', [$request->id]);;
            return response()->json(['stuff' => $selected_stuff]);
        } catch (PDOException $ex) {
            $error_data = response()->json(['errors' => [
                'code'      => $ex->errorInfo[0],
                'message'   => $ex->errorInfo[2],
                'status'    => 'failed'
            ]]);
            return $error_data;
        }
       /*  if ($this->validateStuff($request) === true) {
            $newStuff = Stuff::select('select * from stuffs where id = ?', [$request->id]);
            $newStuff->code             = $request->code;
            $newStuff->name             = $request->name;
            $newStuff->latin_name       = $request->latin_name;
            $newStuff->has_unique_serial= $request->has_unique_serial;
            $newStuff->unit_id          = $request->unit_id;
            $newStuff->description      = $request->description;
            $newStuff->creator_user_id  = $request->creator_user_id;
            $newStuff->modifier_user_id  = $request->modifier_user_id;

            $newStuff->save();
            return response()->json();
        }*/
    }

    public function editStuff(Request $request)
    {
        if( $this->validateStuff($request) === true )
        {
            try {
                $updateList = [];

                $updateList['code'] = $request->code;
                $updateList['name'] = $request->name;
                $updateList['latin_name'] = $request->latin_name;
                $updateList['has_unique_serial'] = $request->has_unique_serial;
                $updateList['unit_id'] = $request->unit_id;
                $updateList['description'] = $request->description;
                $updateList['modifier_user_id'] = $request->user()->id;

                DB::table('stuffs')->where('id',$request->id)->update($updateList);
            } catch (\Throwable $ex) {
                $error_data = response()->json(['errors' => [
                    'code'      => $ex->errorInfo[0],
                    'message'   => $ex->errorInfo[2],
                    'status'    => 'failed'
                ]]);
                return $error_data;
            }
        }
    }
}
