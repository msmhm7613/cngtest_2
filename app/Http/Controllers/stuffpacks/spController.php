<?php

namespace App\Http\Controllers\stuffpacks;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Stuffpack;
use App\Models\StuffpackList;
use PDOException;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

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
            return response()->json(['errors' => $validator->getMessageBag()]);
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
                $this->insertToStuffpackLists($request->list,$sp->id);

                return response()->json(['status' => 'ok']);
            } catch (PDOException $ex) {
                return response()->json(['errors' => $ex]);
            }
        }
    }


    // select stuffpack and return its data to ajax
    public function select(Request $request)
    {
        $stuffpack_id = $request->id;
        try {
            $stuffpack = \App\Models\Stuffpack::select()->where('id', $request->id)->first();
            return response()->json($stuffpack);
        } catch (PDOException $ex) {
            return response()->json(['errors' => $ex->errorInfo]);
        }
    }

    //edit
    public function edit(Request $request)
    {
        $stuffpack = $this->select($request);
        //return response()-> json([$stuffpack]);
        return view('stuff-pack.edit-form')->with('stuffpack', json_encode($stuffpack->original));
    }

    public function update(Request $request)
    {
        $rules = [
            'code' => ['string', 'min:3', 'max:30', 'required',],
            'name' => ['string', 'min:3', 'max:30', 'required',],
            'description' => ['string', 'max:255', 'nullable',],
            'serial' => ['string', 'min:1', 'max:64', 'nullable',]
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->getMessageBag()]);
        } else {

            try {
                $updateList = [];
                //$selected_stuff = $this->selectStuff($request->stuff_id);
                $updateList['code'] = $request->code;
                $updateList['name'] = $request->name;
                $updateList['serial'] = $request->serial;
                $updateList['description'] = $request->description;
                $updateList['modifier_user_id'] = $request->user()->id;

                $updateList['updated_at'] = Carbon::now();

                DB::table('stuffpacks')->where('id', $request->stuffpack_id)->update($updateList);
                $spl = $request->list; // stuffpack list
                $reportList = [];

                DB::statement('SET FOREIGN_KEY_CHECKS=0');
                $deleted_stuffpacks = DB::table('stuffpack_lists')->where('stuffpack_id',$request->stuffpack_id)->delete();
                DB::statement('SET FOREIGN_KEY_CHECKS=1');

                $saved = $this->insertToStuffpackLists($spl,$request->stuffpack_id);
                return response()->json(['status' => 'ok', 'request list' => $spl, 'report list' => $reportList, 'deleted stuffpacks' => $deleted_stuffpacks, 'saved'=>$saved, 'stuffpack id' => $request->stuffpack_id]);
            } catch (PDOException $ex) {
                return response()->json(['errors' => $ex]);
            }
        }
    }
    public function insertToStuffpackLists($spList,$sp_id)
    {

        foreach ($spList as $key => $value) {
            try {
                $stuffpack_item = new StuffpackList();
                $stuffpack_item->stuffpack_id = intval($sp_id);
                $stuffpack_item->stuff_id = intval($value['id']);
                $stuffpack_item->stuff_count = intval($value['num']);
                $stuffpack_item->save();
            } catch (PDOException $ex) {
                return response()->json(['errors' => $ex->errorInfo]);
            }
        }
    }

    public function delete(Request $request)
    {
        try {
            DB::table('stuffpacks')->delete($request->id);
            return response()->json(['status'=>'ok']);
        } catch (PDOException $ex) {
            return response()->json(['errors'=>$ex->errorInfo]);
        }
    }
}
