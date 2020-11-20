<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
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
            'username' => 'required|min:3|max:25',
            'password' => 'required|min:8|max:25',
            'acc_arr' => 'required'
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {

            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {
            try {

                $c = count($request->acc_arr);

                $acc_string = '';

                $acc_string = $request->acc_arr[0];

                for ($i = 1; $i < $c; $i++) {
                    $acc_string .= ',' . $request->acc_arr[$i];
                }

                $newUser = new User();
                $newUser->username = $request->username;
                $newUser->password = Hash::make($request->password);
                $newUser->role = 1;
                $newUser->title     = $request->username;
                $newUser->access = $acc_string;
                $newUser->save();
                /* return response('کاربر با موفقیت ثبت شد');*/

                return view('layouts.tables.users');
            } catch (\Illuminate\Database\QueryException $ex) {
                //if($ex->errorInfo[0] == 23000)
                $error_data = response()->json(['errors' => [
                    'code' => $ex->errorInfo[0],
                    'message' => $ex->errorInfo[2],
                    'status' => 'failed'
                ]]);
                return $error_data;
            }
        }
    }

    public function selectUser(Request $request)
    {

        try {

            $selected_user = DB::select('select * from users where id = ?', [$request->id]);
            return response()->json(['user' => $selected_user]);
        } catch (PDOException $ex) {
            $error_data = response()->json(['errors' => [
                'code' => $ex->errorInfo[0],
                'message' => $ex->errorInfo[2],
                'status' => 'failed'
            ]]);
            return $error_data;
        }
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
            $newUser->role = 1;
            $newUser->title = $request->username;
            $newUser->save();
            return response()->json();
        }
    }

    public function editUser(Request $request)
    {
        if ($request->id === 1)
            return;

        $rules = array(
            'username' => '',
            'password' => '',
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {

            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {
            try {

                $c = count($request->acc_edit);

                $acc_string = '';

                $acc_string = $request->acc_edit[0];

                for ($i = 1; $i < $c; $i++) {
                    $acc_string .= ',' . $request->acc_edit[$i];
                }

                $updateList = [];

                if ($request->username) {
                    $updateList['username'] = $request->username;
                }
                if ($request->password) {
                    $updateList2['passwordcheck'] = 'darim';
                    $updateList['password'] = Hash::make($request->password);
                } else {
                    $updateList2['passwordcheck'] = 'nadarim';
                }
                $updateList['role'] = $request->role;
                $updateList['title'] = $request->title;
                $updateList['access'] = $acc_string;

                DB::table('users')->where('id', $request->id)
                    ->update($updateList);
                return response()->json([$updateList, $updateList2]);
            } catch (\Illuminate\Database\QueryException $ex) {
                //if($ex->errorInfo[0] == 23000)
                $error_data = response()->json(['errors' => [
                    'code' => $ex->errorInfo[0],
                    'message' => $ex->errorInfo[2],
                    'status' => 'failed'
                ]]);
                return $error_data;
            }
        }
    }

    public function deleteUser(Request $request)
    {
        /*         if($request->id === 1)
                return;
                $numberOfAdmins = count(DB::select('select * from users where role = ?', [1]));
                if ($request->role == 1 && $numberOfAdmins < 2 )
                {
                    return response()->json(['errors'=>[
                        'msg' => 'شما باید حداقل یک ادمین داشته باشید',
                        'number_of_admins' => $numberOfAdmins,
                    ]]);
                } */

        try {
            //return DB::table('users')->select()->where('id','=',$request->id);
            DB::table('users')->delete($request->id);
            return response('کاربر حذف شد');

        } catch (PDOException $ex) {

            return response()->json([$ex->errorInfo]);
        }
    }
}
