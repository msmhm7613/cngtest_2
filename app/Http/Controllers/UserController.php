<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use PDOException;

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

            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {
            try {
                $newUser = new User();
                $newUser->username = $request->username;
                $newUser->password = Hash::make($request->password);
                $newUser->role      = $request->role;
                $newUser->title     = $request->title;
                $newUser->save();
                return response('کاربر با موفقیت ثبت شد');
            } catch (\Illuminate\Database\QueryException $ex) {
                //if($ex->errorInfo[0] == 23000)
                $error_data = response()->json([ 'errors'=> [
                    'code'      => $ex->errorInfo[0],
                    'message'   => $ex->errorInfo[2],
                    'status'    => 'failed']
                ]);
                return $error_data;
            }

        }
    }
    public function editUser(Request $request)
    {

        $rules = array(
            'username' => 'required|min:3|max:25',
            'password' => 'required|min:8|max:25',
            'id' => ['numeric', 'min:7'],
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
