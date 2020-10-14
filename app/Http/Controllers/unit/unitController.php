<?php

namespace App\Http\Controllers\unit;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class unitController extends Controller
{
    protected $rules = [
        'name' => ['string', 'min:3', 'max:30', 'required', 'alpha_dash'],
        'code' => ['string', 'min:3', 'max:30', 'nullable', 'alpha_dash'],
        'creator_user_id' => ['numeric', 'exists:users,id'],

    ];
    function validate(Request $request, array $rules, array $messages = [], array $customAttributes = [])
    {
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        return true;
    }

    public function insert(Request $request)
    {
        if($this->validate(
            $request,$this->rules
        ))

        DB::table('units')->insert($request->all());

    }
}
