<?php

namespace App\Http\Controllers\store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class storeController extends Controller
{
    public function insert(Request $request)
    {
        $rules = [
            'name' => ['string', 'min:3', 'max::25', 'required', 'alpha_dash','unique:stores,name'],
            'user_id' => ['required','numeric','exists:users,id'],
            'creator_user_id' => ['required', 'numeric', 'exists:users,id'],
            'phone' => ['numeric', 'nullable'],
            'mobile' => ['digits:11', 'nullable'],
            'address' => ['string', 'nullable', 'max:255'],
            'description' => ['string', 'nullable', 'max:255'],
        ];

        $validator = Validator::make($request->all(),$rules);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
            return redirect('store/insert')->withErrors($validator)->withInput();
            return response()->json(['errors'=>$validator->errors()->messages()]);
        }

        DB::insert('users', $request->all());

        
    }
}
