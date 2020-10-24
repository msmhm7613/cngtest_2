<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PDOException;

class StuffpackController extends Controller
{
    public function validator(Request $request)
    {
        $rules = [
            'code' => ['string', 'alpha-dash', 'min:3', 'max:30', 'required',],
            'name' => ['string', 'min:3', 'max:30', 'required',],
            'description' => ['string', 'alpha-dash', 'max:255', 'nullable',],
            'creator_user_id' => ['numeric', 'exists:users,id', 'required'],
            'modifier_user_id' => ['numeric', 'exists:users,id', 'required'],
            'serial' => ['string', 'min:1', 'max:64', 'required',]
        ];

        $validator = Validator::make($request, $rules);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->getMessageBag()->toArray()]);
        } else {
            return response()->json('success');
        }
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

