<?php

namespace App\Http\Controllers\tempstore;

use App\Http\Controllers\Controller;
use App\Models\TempStore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class TempstoreController extends Controller
{
    public function insert(Request $request)
    {
        $rules = [
            'name' => ['string', 'required', 'min:3', 'max:25', 'unique:tempstores'],
            'manager' => ['string', 'min:3', 'max:25', 'nullable'],
            'code' => ['string', 'min:3', 'max:25', 'nullable'],
            'phone' => ['string', 'min:3', 'max:25', 'nullable'],
            'mobile' => ['string', 'min:3', 'max:25', 'nullable'],
            'address' => ['string', 'min:3', 'max:25', 'nullable'],
            'description' => ['string', 'min:3', 'max:25', 'nullable'],
        ];

        $msg = [
            'name.unique' => 'نام کارگاه قبلا در سیستم ثبت شده است',
            'name.required' => 'فیلد نام کارگاه خالی میباشد',
        ];

        $validatore = Validator::make(
            $request->all(),
            $rules,
            $msg
        );

        if ($validatore->fails()) {
            return response()->json([
                'errors' => $validatore->getMessageBag()->toArray()
            ]);
        }

        // insert new tempstore

        try {
            TempStore::create($request->all());
        } catch (Exception $ex) {
            return response()->json(
                [
                    'errors' => $ex->getMessage()
                ]
            );
        }
    }

}
