<?php

namespace App\Http\Controllers\stuffpacks;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Stuffpack;
use PDOException;

class spController extends Controller
{
    public function insert(Request $request)
    {
        $rules = [
            'code' => ['string', 'min:3', 'max:30', 'required',],
            'name' => ['string', 'min:3', 'max:30', 'required',],
            'description' => ['string', 'max:255', 'nullable',],
            'creator_user_id' => ['numeric', 'exists:users,id', 'required'],
            'modifier_user_id' => ['numeric', 'exists:users,id', 'required'],
            'serial' => ['string', 'min:1', 'max:64', 'required',]
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->getMessageBag()]);
        } else {

            try {
                $sp = new Stuffpack();

                $sp->name = $request->name;
                $sp->code = $request->code;
                $sp->description = $request->description;
                $sp->creator_user_id = $request->creator_user_id;
                $sp->modifier_user_id = $request->modifier_user_id;
                $sp->serial = $request->serial;

                $sp->save();
                return response('saved');
            } catch (PDOException $ex) {
                return response()->json(['errors' => $ex ]);
            }
        }
    }
}
