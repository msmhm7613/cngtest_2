<?php

namespace App\Http\Controllers\stuff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class stuffController extends Controller
{
    protected $rules = [
        'code' => ['string', 'alpha_dash', 'min:3', 'max:64', 'required', 'unique:stuffs,code',],
        'name' => ['string', 'alpha_dash', 'min:3', 'max:64', 'required'],
        'latin_name' => ['string', 'alpha_dash', 'min:3', 'max:64', 'nullable'],
        'has_unique_serial' => ['boolean'],
        'creator_user_id' => ['numeric', 'exists:users,id'],
        'description' => ['string', 'max:255', 'nullable'],
    ];

    function validate(Request $request, array $rules, array $messages = [], array $customAttributes = [])
    {
        $validator = Validator::make($request,$rules);
        if ( $validator->fails() )
            return redirect()->back()->withErrors($validator)->withInput();
        return true;
    }

    public function insert($request)
    {
        if ( $this->validate($request,$this->rules) )
            DB::table('stuffs')->insert($request->all());
    }
}
