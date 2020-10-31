<?php

namespace App\Http\Controllers\stuffpacks;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Stuffpack;
use App\Models\StuffpackList;
use PDOException;

class spController extends Controller
{
    public function insert(Request $request)
    {
        $rules = [
            'code' => ['string', 'min:3', 'max:30', 'required', 'unique:stuffpacks,code'],
            'name' => ['string', 'min:3', 'max:30', 'required',],
            'description' => ['string', 'max:255', 'nullable',],
            'serial' => ['string', 'min:1', 'max:64', 'nullable',]
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['errors' => ['validator' => $validator->getMessageBag()]]);
        } else {

            try {
                $sp = new Stuffpack();

                $sp->name = $request->name;
                $sp->code = $request->code;
                $sp->description = $request->description;
                $sp->creator_user_id = $request->user()->id;
                $sp->modifier_user_id = $request->user()->id;
                $sp->serial = $request->serial;
                $sp->list_of_stuffs = json_encode(['list' => $request->list]);

                $sp->save();
                $sp_id = $sp->id;
                $spList = $request->list;

                foreach ($spList as $key => $value) {
                    try {
                        $stuffpack_item = new StuffpackList();
                        $stuffpack_item->stuffpack_id = $sp_id;
                        $stuffpack_item->stuff_id = $value['id'];
                        $stuffpack_item->stuff_count = $value['num'];
                        $stuffpack_item->save();
                    } catch (PDOException $ex) {
                        return response()->json(['errors' => $ex->errorInfo]);
                    }
                }
                return response()->json(['status' => 'ok']);
            } catch (PDOException $ex) {
                return response()->json(['errors' => $ex]);
            }
        }
    }
}
