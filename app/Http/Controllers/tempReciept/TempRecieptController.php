<?php

namespace App\Http\Controllers;

use App\Models\TempReciept;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PDOException;

class TempRecieptController extends Controller
{
    public function insert(Request $request)
    {

        try {
            $newTempRec = new \App\Models\TempReciept();
            $newTempRec->reciept_no = $request->reciept_id;
            $newTempRec->sender = $request->sender;
            $newTempRec->referral_number = $request->ref_no;
            $newTempRec->referral_date = $request->ref_date;
            $newTempRec->description = $request->descriptiom;
            $newTempRec->creator_id = 1; //$request['temp-reciept-car-type-input'];
            $newTempRec->confirmer_id = 1; //$request->confirmer_id;
            $newTempRec->car_no = $request->car_no;
            $newTempRec->car_type = $request->car_type;
            $newTempRec->driver = $request->driver;

            $newTempRec->save();



            $newTempRec_id = $newTempRec->id;

            foreach ($request->items_list as $key => $value) {
                $reciept_item_list = new \App\Models\TempRecieptList();
                $reciept_item_list->reciept_id = $newTempRec_id;
                $reciept_item_list->stuffpack_id = $value[6] ? $value[0] : 0;
                $reciept_item_list->stuff_id = $value[6] ? 