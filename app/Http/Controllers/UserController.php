<?php

namespace App\Http\Controllers;

use App\Models\User;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function newUser(Request $request)
    {

        $rules = array(
            'username' => 'required',
            'password' => 'required',
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {

            return response()->json(array('errors' => $validator->getMessageBag()));
        } else {
            $newUser = new User();
            $newUser->username = $request->username;
            $newUser->password = Hash::make($request->password);
            $newUser->role      = $request->role;
            $newUser->title     = $request->title;
            $newUser->save();
            return response()->json();
        }
    }
    public function editUser(Request $request)
    {

        $rules = array(
            'username' => 'required',
            'password' => 'required',
            'id'=>['numeric','min:7'],
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {

            return response()->json(array('errors' => $validator->getMessageBag()));
        } else {
            $newUser = User::select('select * from users where id = ?', [$request->id]);
            $newUser->username = $request->username;
            $newUser->password = Hash::make($request->password);
            $newUser->role      = $request->role;
            $newUser->title     = $request->title;
            $newUser->save();
            return response()->json();
        }
    }
}
