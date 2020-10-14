<?php

namespace App\Http\Controllers\stuff;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PDOException;
use App\Models\Stuff;

class stuffController extends Controller
{
    public function insert(Request $request)
    {
        $rules = [
            'code' => ['string', 'alpha_dash', 'min:3', 'max:64', 'required', 'unique:stuffs,code',],
            'name' => ['string', 'alpha_dash', 'min:3', 'max:64', 'required'],
            'latin_name' => ['string', 'alpha_dash', 'regex:/^[a-zA-Z1-9]+$/u', 'min:3', 'max:64', 'nullable'],
            'has_unique_serial' => ['boolean'],
            'creator_user_id' => ['numeric', 'exists:users,id'],
            'description' => ['string', 'max:255', 'nullable'],
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {

            return response()->json(['errors' => $validator->getMessageBag()]);
        }

        try{
            $stuff = new Stuff();
            $stuff->code = $request->code; //return response('try');
            $stuff->name = $request->name;
            $stuff->latin_name = $request->latin_name;
            $stuff->creator_user_id = $request->user()->id;
            $stuff->has_unique_serial = $request->has_unique_serial;
            $stuff->unit_id = $request->unit_id;
            $stuff->description = $request->description;
            $stuff->save();
            return response('کالا ثبت شد');
        }catch(Exception $ex)
        {
            return response()->json(['errors'=>$ex->getMessage()]);
        }


    }
}
