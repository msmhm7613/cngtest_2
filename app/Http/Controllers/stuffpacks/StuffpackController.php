<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PDOException;

class StuffpackController extends Controller
{
    public function validator(Request $request)
    {
        
    }

    public function insert(Request $request)
    {
        return response('man injam.');
        if ($this->validator($request)->errors) {
            return  $this->validator($request)->errors;
        } else {
            try {

                $stuff_pack = new \App\Models\Stuffpack();

                $stuff_pack->name = $request->name;
                $stuff_pack->code = $request->code;
                $stuff_pack->serial = $request->serial;
                $stuff_pack->creator_user_id = $request->creator_userid_;
                $stuff_pack->modifier_user_id = $request->modifier_user_id;
                $stuff_pack->description = $request->description;

                $stuff_pack->save();
            } catch (PDOException $ex) {
                return response()->json(['errors'=>$ex]);
            }
        }
    }

    public function select(Request $request)
    {
        return response('select');
    }
    public function edit(Request $request)
    {
        return response('edit');
    }
    public function delete(Request $request)
    {
        return response('delete');
    }
}

