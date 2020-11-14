<?php

namespace App\Http\Controllers\car;

use App\Http\Controllers\Controller;
use App\Imports\CarQueueImport;
use App\Imports\StuffImport;
use App\Models\CarQueue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class carController extends Controller
{
    /*
     * upload cars queue
     */
    public function upload(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'file' => [
                    'required',
                    'mimes:csv,xls,xlsx'
                ]
            ],
            [
                'file.required' => "فایلی ارسال نشده است !",
                'file.mimes' => "تنها فرمت csv قابل پذیرش است"
            ]
        );
        $rule = [
            'track_number' => 'required',
            'turn_date' => 'required',
            'status' => 'required',
            'owner_name' => 'required',
            'owner_id' => 'required',
            'owner_phone' => 'required',
            'tag' => 'required',
            'car_type' => 'required',
            'car_brand' => 'required',
            'car_model' => 'required',
            'state' => 'required',
            'city' => 'required',
            'contractor' => 'required',
            'workshop' => 'required',
            'workshop_state' => 'required',
            'workshop_city' => 'required',
            'workshop_address' => 'required',
            'workshop_phone' => 'required',
        ];
        if ($validate->fails()) {
            dd($request->file);
            $message = "فرمت فایل ارسالی قابل قبول نیست !";
            return "
            <script>
        window.alert('$message');
                window.location = '/';
    </script>
        ";
        }
        $error = [];
        $file = $request->file;
        $fileName = uniqid();
        $fileName = $fileName . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('tempUpload/'), $fileName);
        $getline = Excel::toArray(new CarQueueImport, public_path('tempUpload/' . $fileName));
        unlink(public_path('tempUpload/' . $fileName));
        foreach ($getline[0] as $l => $getattr) {
            if ( $l == 0) {
                continue;
            }
            $arr = $this->reindex($getattr);
            if ($arr == -1) {
                $message = "در سطر $l تعداد ستون ها کافی نمیباشد";
                array_push($error, $message);
                continue;
            }
            $validator = Validator::make($arr, $rule);
            if ($validator->fails()) {
                $message = "نیاز به بررسی در خط $l";
                array_push($error, $message);
                continue;
            }
            try {
                CarQueue::create($arr);
            } catch (Exception $ex) {
                $message = "نیاز به بررسی در خط $l";
                array_push($error, $message);
                continue;
            }
        }
        $m = '';
        if (count($error) > 0) {
            foreach ($error as $e) {
                $m .= $e . "       ";
            }
            return "
            <script>
        window.alert('$m');
                window.location = '/';
    </script>
        ";
        } else {
            return back();
        }

    }

    /*
     * index array from csv
     */
    public function reindex($arr = [])
    {
        isset($arr[26]) ? $engin = $arr[26] : $engin = "";
        if (count($arr) == 18) {
            $retArr = [
                'track_number' => $arr[0],
                'turn_date' => $arr[1],
                'status' => $arr[2],
                'owner_name' => $arr[3],
                'owner_id' => $arr[4],
                'owner_phone' => $arr[5],
                'tag' => $arr[6],
                'car_type' => $arr[7],
                'car_brand' => $arr[8],
                'car_model' => $arr[9],
                'state' => $arr[10],
                'city' => $arr[11],
                'contractor' => $arr[12],
                'workshop' => $arr[13],
                'workshop_state' => $arr[14],
                'workshop_city' => $arr[15],
                'workshop_address' => $arr[16],
                'workshop_phone' => $arr[17],
                'convert_date' => $arr[18],
                'convert_id' => "",
                'tank_size' => "",
                'tank_id' => "",
                'tank_valve' => "",
                'regulator_id' => "",
                'convert_certificate_id' => "",
                'health_certificate_id' => "",
                'engine_id' => $engin,
            ];
        } elseif (count($arr) == 27) {
            $retArr = [
                'track_number' => $arr[0],
                'turn_date' => $arr[1],
                'status' => $arr[2],
                'owner_name' => $arr[3],
                'owner_id' => $arr[4],
                'owner_phone' => $arr[5],
                'tag' => $arr[6],
                'car_type' => $arr[7],
                'car_brand' => $arr[8],
                'car_model' => $arr[9],
                'state' => $arr[10],
                'city' => $arr[11],
                'contractor' => $arr[12],
                'workshop' => $arr[13],
                'workshop_state' => $arr[14],
                'workshop_city' => $arr[15],
                'workshop_address' => $arr[16],
                'workshop_phone' => $arr[17],
                'convert_date' => $arr[18],
                'convert_id'=>$arr[19],
                'tank_size' => $arr[20],
                'tank_id' => $arr[21],
                'tank_valve' => $arr[22],
                'regulator_id' => $arr[23],
                'convert_certificate_id' => $arr[24],
                'health_certificate_id' => $arr[25],
                'engine_id' => $engin,
            ];
        } else {
            return -1;
        }
        return $retArr;
    }

    /*
     * single create queue
     */
    public function insert(Request $request)
    {
        $rule = [
            'track_number' => 'required',
            'turn_date' => 'required',
            'status' => 'required',
            'owner_name' => 'required',
            'owner_id' => 'required',
            'owner_phone' => 'required',
            'tag' => 'required',
            'car_type' => 'required',
            'car_brand' => 'required',
            'car_model' => 'required',
            'state' => 'required',
            'city' => 'required',
            'contractor' => 'required',
            'workshop' => 'required',
            'workshop_state' => 'required',
            'workshop_city' => 'required',
            'workshop_address' => 'required',
            'workshop_phone' => 'required',
        ];
        $validator = Validator::make($request->all(), $rule);
        if ($validator->fails()) {
            $message = "فیلد های الزامی پرنشده";
            return "
            <script>
                 window.alert('$message');
                 window.location = '/';
          </script>
        ";
        }
        try {
            CarQueue::create($request->all());
        } catch (Exception $ex) {
            $message = "خطا در ذخیره اطلاعات";
            return "
            <script>
                 window.alert('$message');
                 window.location = '/';
          </script>
        ";
        }
        return back();

    }
    /*
     * show edit form
     */
    public function edit(Request $request){
        $car = CarQueue::findOrFail($request['target']);
        return view('car.edit',compact('car'));
    }
    /*
     * update a row
     */
    public function update(Request $request){
        $rule = [
            'track_number' => 'required',
            'turn_date' => 'required',
            'status' => 'required',
            'owner_name' => 'required',
            'owner_id' => 'required',
            'owner_phone' => 'required',
            'tag' => 'required',
            'car_type' => 'required',
            'car_brand' => 'required',
            'car_model' => 'required',
            'state' => 'required',
            'city' => 'required',
            'contractor' => 'required',
            'workshop' => 'required',
            'workshop_state' => 'required',
            'workshop_city' => 'required',
            'workshop_address' => 'required',
            'workshop_phone' => 'required',
        ];
        $validator = Validator::make($request->all(), $rule);
        if ($validator->fails()) {
            $message = "فیلد های الزامی پرنشده";
            return "
            <script>
                 window.alert('$message');
                 window.location = '/';
          </script>
        ";
        }
        $data = $request->all();
        unset($data['id']);
        unset($data['_token']);
        try {
            CarQueue::whereId($request['id'])->update($data);
        }catch (Exception $ex) {
            $message = "خطا در ذخیره اطلاعات";
            return "
            <script>
                 window.alert('$message');
                 window.location = '/';
          </script>
        ";
        }

        return back();
    }
}
