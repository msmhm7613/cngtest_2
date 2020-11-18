<?php

namespace App\Http\Controllers\stuff;

use App\Http\Controllers\Controller;
use App\Imports\StuffImport;
use App\Models\Stuffpack;
use App\Models\StuffpackList;
use App\Models\Unit;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use PDOException;
use App\Models\Stuff;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use App\Models\TempReciept;
use App\Models\TempRecieptList;

class stuffController extends Controller
{

    public function validateStuff(Request $request)
    {
        $rules = [
            'code' => ['required', 'string', 'alpha_dash', 'min:3', 'max:64', 'unique:stuffs,code',],
            'name' => ['required', 'string', 'regex:/^[\pL0-9 -_]+$/u', 'min:3', 'max:64',],
            'latin_name' => ['string', 'regex:/^[a-zA-Z0-9 -_]+$/u', 'min:3', 'max:64', 'nullable'],
            'has_unique_serial' => ['boolean'],
            'creator_user_id' => ['numeric', 'exists:users,id'],
            'description' => ['string', 'max:255', 'nullable'],
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {

            return response()->json(['errors' => $validator->getMessageBag()]);
        }
        return true;
    }

    public function insert(Request $request)
    {

        $rules = [
            'code' => ['required', 'string', 'min:3', 'max:64', 'unique:stuffs,code',],
            'name' => [
                'required',
                'string',
                //'regex:/^[\pL0-9 -_]+$/u',
                'min:3',
                'max:64',
            ],
            'latin_name' => [
                'string',
                //'regex:/^[a-zA-Z0-9 -_]+$/u',
                'min:3',
                'max:64',
                'nullable'
            ],
            'has_unique_serial' => ['boolean'],
            'creator_user_id' => ['numeric', 'exists:users,id', 'required'],
            'modifier_user_id' => ['numeric', 'exists:users,id', 'required'],
            'description' => ['string', 'max:255', 'nullable'],
        ];

        $msg = [

            //code
            'code.required' => 'کد کالا الزامی است',
            'code.string' => 'کد کالا باید رشته باشد',
            'code.min' => 'کد کالا حداقل باید 3 کاراکتر باشد',
            'code.max' => 'کد کالا حداکثر میتواند 64 کاراکتر باشد',
            'code.unique' => 'کد کالا قبلا ثبت شده است.',

            //name
            'name.required' => 'نام کالا الزامی است',
        ];
        $validator = Validator::make($request->all(), $rules, $msg);

        if ($validator->fails()) {

            return response()->json(['errors' => $validator->getMessageBag()]);
        }

        try {
            $stuff = new Stuff();
            $stuff->code = $request->code; //return response('try');
            $stuff->name = $request->name;
            $stuff->latin_name = $request->latin_name;
            $stuff->creator_user_id = $request->user()->id;
            $stuff->modifier_user_id = $request->user()->id;
            $stuff->has_unique_serial = $request->has_unique_serial;
            $stuff->unit_id = $request->unit_id;
            $stuff->description = $request->description;
            $stuff->save();

            return view('stuff.table');
        } catch (Exception $ex) {
            return response()->json(['errors' => $ex->getMessage()]);
        }
    }

    /*
     * Upload file and insert to data base
     */
    public function UploadStuff(Request $request)
    {
        /* $file = $request->file('file')->store('xlsx');
        return response()->json(['file'=>$file]); */
        $file = $request->file('file')->store('stuffs');
        $uploadedFile = Excel::toArray(new StuffImport, $file);
        $validator = Validator::make(
            $uploadedFile,
            [
                'file' => [
                    'required',
                    'mimes:csv,xls,xlsx'
                ]
            ],
            [
                'file.required' => "فایل ارسالی مطابق نمونه نیست.لطفا نمونه فایل را دانلود کنید. !",
                'file.mimes' => "فرمت فایل قابل قبول نیست"
            ]
        );
        if ($validator->fails()) {
            
            //return response()->json(['errors' => $validator->errors()->all(), 'file' => $uploadedFile ]);
        }
        $rules = [
            'code' => ['required', 'string', 'min:3', 'max:64', 'unique:stuffs,code',],
            'name' => ['required',
            'string',
            //'regex:/^[\pL0-9 -_]+$/u',
            'min:3',
            'max:64',
        ],
            'latin_name' => ['string',
            //'regex:/^[a-zA-Z0-9 -_]+$/u',
            'min:3',
            'max:64',
            'nullable'
        ],
            'has_unique_serial' => ['boolean'],
            'creator_user_id' => ['numeric', 'exists:users,id', 'required'],
            'modifier_user_id' => ['numeric', 'exists:users,id', 'required'],
            'description' => ['string', 'max:255', 'nullable'],
        ];

        $msg = [

            //code
            'code.required' => 'کد کالا الزامی است',
            'code.string' => 'کد کالا باید رشته باشد',
            'code.min' => 'کد کالا حداقل باید 3 کاراکتر باشد',
            'code.max' => 'کد کالا حداکثر میتواند 64 کاراکتر باشد',
            'code.unique' => 'کد کالا قبلا ثبت شده است.',

            //name
            'name.required' => 'نام کالا الزامی است',
        ];
        $errors = [];
        
       
        $getline = Excel::toArray(new StuffImport,$file);
        $ind = 0;
        foreach ($getline[0] as $l => $getattr) {
            //exit(dd($l));
           
            if (count($getattr) < 6 && $l === 0 ) {
                $message = "در سطر $l تعداد ستون ها کافی نمیباشد";
                array_push($errors, $message);
            break;
            }
            if (count($getattr) > 6 && $l === 0 ) {
                $message = "در سطر $l تعداد ستون ها بیشتر از حد انتظار است";
                array_push($errors, $message);
            break;
            }

            if ( $l === 0) {
                continue;
            }
            
            if (!$unitid = Unit::where('name', 'LIKE', '%' . trim($getattr[4]) . '%')->first()) {
                $message = "واحد اندازه گیری یافت نشد در سطر $l";
                array_push($errors, $message);
                continue;
            }else{
                $unitid = $unitid->id;
            }
            $val = [
                'code' => trim($getattr[0]),
                'name' => trim($getattr[1]),
                'latin_name' => trim($getattr[2]),
                'has_unique_serial' => $getattr[3] ?? 0,
                'creator_user_id' => auth()->id() ?? Auth()->user->id(),
                'modifier_user_id' => auth()->id() ?? Auth()->user->id(),
                'unit_id' => $unitid ?? 1,
                'description' => (trim($getattr[5]) == "") ? "ندارد": trim($getattr[5]),
            ];
            $validator = Validator::make($val, $rules, $msg);
            if ($validator->fails()) {
                
                array_push($errors,[$l => $validator->getMessageBag()]);
                continue;
            }
            try {
                
                Stuff::create($val);
                $ind ++;
            } catch (Exception $ex) {
                $message = "نیاز به بررسی در خط $l".' :<p class="eng"> '.$ex->getMessage() . "</p>";
                array_push($errors, $message);
                continue;
            }
        }
            return response()->json([ 'errors' => $errors,'success'=> $ind]);
    }


    /*
        SELECT STUFF FOR EDIT
    */
    public function selectStuff(Request $request)
    {


        try {
            $stuff = Stuff::find($request->id); //DB::table('stuffs')->where('id',"=",$stuff_id)->first();
            return response($stuff);
            // response()->json(['stuff' => $selected_stuff]);
        } catch (PDOException $ex) {
            return response()->json(['errors' => [
                'code' => $ex->errorInfo[0],
                'message' => $ex->errorInfo[2],
                'status' => 'failed'
            ]]);
        }
    }

    public function editStuff(Request $request)
    {
        //$selected_stuff = $this->selectStuff($request->stuff_id);

        $rules = [
            'code' => ['string', 'alpha_dash', 'min:3', 'max:64', 'required',],
            'name' => ['string', 'regex:/^[\pL0-9 -_]+$/u', 'min:3', 'max:64', 'required'],
            'latin_name' => ['string', 'regex:/^[a-zA-Z0-9 -_]+$/u', 'min:3', 'max:64', 'nullable'],
            'has_unique_serial' => ['boolean'],
            'description' => ['string', 'max:255', 'nullable'],
            'id' => ['numeric', 'exists:stuffs,id', 'required'],
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {

            return response()->json(['errors' => $validator->getMessageBag()->toArray()]);
        }

        try {
            $updateList = [];
            //$selected_stuff = $this->selectStuff($request->stuff_id);
            $updateList['code'] = $request->code;
            $updateList['name'] = $request->name;
            $updateList['latin_name'] = $request->latin_name;
            $updateList['has_unique_serial'] = $request->has_unique_serial;
            $updateList['unit_id'] = $request->unit_id;
            $updateList['description'] = $request->description;
            $updateList['modifier_user_id'] = $request->user()->id;
            //$updateList['creator_user_id'] = $selected_stuff->creator_user_id;
            $updateList['updated_at'] = Carbon::now();
            //DB::update('update stuffs set code = ?, name = ? , latin_name = ? , has_unique_serial = ? , unit_id = ? , description = ? , modifier_user_id = ? where name = ?', $updateList);
            DB::table('stuffs')->where('id', $request->id)->update($updateList);

            //User::where('id',$request->id)->update($updateList);
            return view('stuff.table');
        } catch (PDOException $ex) {
            $error_data = response()->json(['errors' => $ex]);
            return $error_data;
        }
    }

    public function deleteStuff(Request $request)
    {
        try {
            DB::table('stuffs')->delete($request->id);
            return view('stuff.table');
        } catch (PDOException $ex) {
            $err = $ex->errorInfo;
            if ($err[0] == "23000" && $err[1] == 1451) {
                $stuffpack_id = \App\Models\StuffpackList::select('stuffpack_id')->where('stuff_id', $request->id)->first()->get();
                $stuffpack = \App\Models\Stuffpack::find($stuffpack_id)->first()->name;
                $errorMsg = 'این کالا عضوی از مجموعه کالای ' . "<b>" . $stuffpack . "</b>" . ' میباشد.';
                $errorMsg .= "<br/>";
                $errorMsg .= "ابتدا باید آن مجموعه کالا را حذف کنید.";
                return response()->json(['errors' => $errorMsg]);
            }
            return response()->json(['errors' => $ex->errorInfo]);
        }
    }

    public function uploadStuffFile(Request $request)
    {
        $file = $request->file('stuff_file');
        //Move Uploaded File
        $destinationPath = 'uploads';
        $file->move($destinationPath, $file->getClientOriginalName());

        $json = file_get_contents('uploads\stuffs3.csv');
        $json = json_encode(explode('\\n', $json));
        $json = json_encode(explode(',', $json));
        //exit (dd($json));
        $file_data = json_encode([
            'file_name' => $file->getClientOriginalName(),
            'file_ext' => $file->getClientOriginalExtension(),
            'file_real_path' => $file->getRealPath(),
            'file_size' => $file->getSize(),


        ]);
    }

    public function check_serial($reciept_no)
    {

        // بررسی وضعیت سریال کالاهای موجود در یک رسید موقت
        $reciept = TempReciept::where('reciept_no', $reciept_no)->first();
        if (is_null($reciept))
            return response()->json(['status' => 0, 'msg' => 'رسید موقت پیدا نشد']);

        $recipt_list = TempRecieptList::where('reciept_id', $reciept->id)->get();

        $stuff_arr = array();

        foreach ($recipt_list as $item) {

            $stuff_id = $item->stuff_id;
            $stuffpack_id = $item->stuffpack_id;

            if ($stuff_id != 0) {

                $stuff = Stuff::find($stuff_id);

                if ($stuff->has_unique_serial == 0) {

                    $stuff_arr[] = [
                        'code' => $stuff->code,
                        'name' => $stuff->name,
                        'latin_name' => $stuff->latin_name,
                        'type' => 1
                    ];
                }
                //continue;

            } elseif ($stuffpack_id != 0) {

                $stuffpack = StuffpackList::where('stuffpack_id', $stuffpack_id)->get();
                foreach ($stuffpack as $item) {

                    $stuff = Stuff::find($item->stuff_id);
                    if ($stuff->has_unique_serial == 0) {

                        $stuff_arr[] = [
                            'code' => $stuff->code,
                            'name' => $stuff->name,
                            'latin_name' => $stuff->latin_name,
                            'type' => 2
                        ];
                    }
                    //continue;
                }

            } else {

            }

        }

        return response()->json(['status' => 1, 'result' => $stuff_arr]);
    }
}
