<?php

namespace App\Http\Controllers;

use App\Models\StuffpackList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PDOException;

class StuffpackListController extends Controller
{
    public function insert(Request $request)
    {
        $rules = [
            'stuffpack_id'  => ['numeric', 'required', 'exists:stuffpacks,id'],
            'stuff_id'      => ['numeric', 'required', 'exists:stuffs,id'],
            'stuff_count'   => ['numeric', 'required', 'exists:stuffs,id', 'min:1'],

        ];

        $validator = Validator::make($request, $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->getMessageBag()]);
        }

        try {
            $stuffpack_list = new StuffpackList();
            $stuffpack_list->stuffpack_id = $request->stuffpack_id;
            $stuffpack_list->stuff_id = $request->stuff_id;
            $stuffpack_list->stuff_count = $request->stuff_count;

            $stuffpack_list->save();

            return response()->json(['success'=>'ثبت شد.']);
        } catch (PDOException $ex) {
            return response()->json(['errors' => $ex->errorInfo]);
        }
    }
}
