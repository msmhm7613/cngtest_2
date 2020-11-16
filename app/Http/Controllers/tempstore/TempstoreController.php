<?php

namespace App\Http\Controllers\tempstore;

use App\Http\Controllers\Controller;
use App\Models\TempStore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PDOException;
use Illuminate\Support\Facades\DB;


class TempstoreController extends Controller
{
    public function insert(Request $request)
    {
        //return response()->json(['request ' => $request->all()]);
        $rules = [
            'name' => ['required', 'string', 'min:3', 'max:25', 'unique:tempstores'],
            'manager' => ['string', 'min:3', 'max:25', 'nullable'],
            'code' => ['string', 'min:3', 'max:25', 'nullable'],
            'phone' => ['string', 'min:3', 'max:25', 'nullable'],
            'mobile' => ['string', 'min:3', 'max:25', 'nullable'],
            'address' => ['string', 'min:3', 'max:25', 'nullable'],
            'description' => ['string', 'min:3', 'max:25', 'nullable'],
        ];

        $msg = [
            'name.unique' => 'نام کارگاه قبلا در سیستم ثبت شده است',
            'name.required' => 'فیلد نام کارگاه الزامیست',
            'name.min' => 'نام کارگاه حداقل باید 3 حرف باشد',
            'name.max' => 'نام کارگاه حداکثر میتواند 25 حرف باشد',
        ];

        $validatore = Validator::make(
            $request->all(),
            $rules,
            $msg
        );

        if ($validatore->fails()) {
            return response()->json([
                'errors' => $validatore->getMessageBag(),
                'req'   => $request->all()
            ]);
        }

        // insert new tempstore

        try {
            DB::table('tempstores')->insert(
                [
                    'name' => $request->name,
                    'manager'=>$request->manager ?? "نامشخص",
                    'code'=>$request->code ?? "نامشخص",
                    'phone'=>$request->phone ?? "00000",
                    'mobile'=>$request->mobile ?? "00000",
                    'address'=>$request->address ?? "نامشخص",
                    'description'=>$request->description ?? "نامشخص",

                ]
            );
            return response()->json(['status' => 'ok', 'req' => $request->all()]);
        } catch (PDOException $ex) {
            return response()->json(
                [
                    'errors' => $ex->getMessage()
                ]
            );
        }
    }
}
