<?php

namespace App\Http\Controllers;

use App\Models\TempReciept;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PDOException;

class TempRecieptController extends Controller
{

    public function insert(Request $request)
    {
        $rules = [
            'stuffpack_id'  => ['required', 'numeric', 'min:1', 'exists:stuffpacks,id'],
            'count'         => ['required', 'numeric', 'min:1'],
        ];

        $validator = Validator::make($request, $rules);
        if ($validator->fails()) {
            return response()->json(['errors', $validator->getMessageBag()]);
        }

        try {
            $temp_reciept = new TempReciept();
            $temp_reciept->stuffpack_id = $request->stuffpack_id;
            $temp_reciept->count        = $request->count;

            return response()->json(['stauts'=>'ok']);
        } catch (PDOException $ex) {
            return response()->json(['errors' => $ex->errorInfo]);
        }
    }
}
