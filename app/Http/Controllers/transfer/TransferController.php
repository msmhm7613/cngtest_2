<?php

namespace App\Http\Controllers\transfer;

use App\Http\Controllers\Controller;
use App\Models\StuffpackList;
use App\Models\Transfer;
use App\Models\TransferList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TransferController extends Controller
{
    public function insert(Request $request)
    {

        $rules = [
            'source_temp' => 'integer|required',
            'destination_temp' => 'integer|required',
            'transfer_date' => 'string|required',
            'transfer_number' => 'integer|required',
            'stuffs_id[]' => 'nullable|integer',
            'stuffspack_id[]' => 'nullable|integer',
            'stuffs_num[]' => 'nullable|integer',
            'stuffspack_num[]' => 'nullable|integer',
        ];

        $msg = [

        ];

        $validatore = Validator::make(
            $request->all(),
            $rules,
            $msg
        );

        if ($validatore->fails()) {
            return response()->json([
                'errors' => $validatore->getMessageBag()->toArray()
            ]);
        }

        // check empty list
        if (count($request->stuffs_id) == 0 && count($request->stuffspack_id) == 0)
            return response()->json(['status' => 0, 'msg' => 'هیچ کالا یا مجموعه کالایی برای انتقال مشخص نشده است']);

        // check source & destination
        if ($request->source_temp == $request->destination_temp)
            return response()->json(['status' => 0, 'msg' => 'انبار مبدا و مقصد نباید یکی باشند']);

        try {

            // create transfer

            $transfer = Transfer::create([
                'source_temp' => $request->source_temp,
                'destination_temp' => $request->destination_temp,
                'date' => $request->transfer_date,
                'trans_num' => $request->transfer_number,
                'creator_id' => Auth::id(),
                'modifier_id' => 0
            ]);




            $transfers = array();
            if(isset($request->stuffs_id)) {
                $c_stuffs = count($request->stuffs_id);
                if ($c_stuffs > 0) {
                    for ($i = 0; $i < $c_stuffs; $i++) {
                        $transfers[] = [
                            'transfer_id' => $transfer->id,
                            'stuff_id' => $request->stuffs_id[$i],
                            'stuffpack_id' => 0,
                            'count' => $request->stuffs_num[$i],
                        ];
                    }
                }
            }
            if(isset($request->stuffspack_id)) {
                $c_stuffspack = count($request->stuffspack_id);
                if ($c_stuffspack > 0) {
                    for ($i = 0; $i < $c_stuffspack; $i++) {
                        $transfers[] = [
                            'transfer_id' => $transfer->id,
                            'stuff_id' => 0,
                            'stuffpack_id' => $request->stuffspack_id[$i],
                            'count' => $request->stuffs_num[$i],
                        ];
                    }
                }
            }
            
            // create transfer List
            TransferList::insert($transfers);

        } catch (\Exception $exp) {
            return response(['status' => 0, 'msg' => $exp->getMessage()]);
        }

    }
}
