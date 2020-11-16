<?php

namespace App\Http\Controllers\tempstore;

use App\Http\Controllers\Controller;
use App\Models\TempStore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PDOException;


class TempstoreController extends Controller
{
    public function insert(Request $request)
    {
        //return response()->json(['request ' => $request->all()]);
        $rules = [
            'name' => ['required', 'string', 'min:3', 'max:25', 'unique:tempstores'],
            'manager' => ['string'],
            'code' => ['string','unique:tempstores'],
            'phone' => ['string', ],
            'mobile' => ['string',],
            'address' => ['string',],
            'description' => ['string',],
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
            TempStore::create($request->all());
            return response()->json(['status' => 'ok', 'req'=>$request->all()]);
        } catch (PDOException $ex) {
            return response()->json(
                [
                    'errors' => $ex->getMessage()
                ]
            );
        }
    }

}
