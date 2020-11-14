<?php

namespace App\Http\Controllers\tempstore;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\TryCatch;
use Symfony\Component\Console\Input\Input;

class old extends Controller
{
    //
    public function insert(Request $request)
    {
        /*$rules = [
            'name' => ['string', 'required', 'min:3', 'max:25', 'unique'],
            'manager' => ['string', 'min:3', 'max:25', 'nullable'],
            'code' => ['string', 'min:3', 'max:25', 'nullable'],
            'phone' => ['string', 'min:3', 'max:25', 'nullable'],
            'mobile' => ['string', 'min:3', 'max:25', 'nullable'],
            'address' => ['string', 'min:3', 'max:25', 'nullable'],
            'description' => ['string', 'min:3', 'max:25', 'nullable'],
        ];

        $validatore = Validator::make(
            $request->all(),
            $rules
        );

        if ($validatore->fails()) {
            return response()->json([
                'errors' => $validatore->getMessageBag()->toArray()
            ]);
        }*/

        // insert new tempstore
        try {
            $tempstore = new old();
            $tempstore->name = $request->name;
            $tempstore->manager = $request->manager;
            $tempstore->code = $request->code;
            $tempstore->phone = $request->phone;
            $tempstore->mobile = $request->mobile;
            $tempstore->description = $request->description;
            $tempstore->save();
        } catch (Exception $ex) {
            return response()->json(
                [
                    'errors' => $ex->getMessage()
                ]
            );
        }
    }
}
