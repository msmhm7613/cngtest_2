<?php

namespace App\Http\Controllers\transfer;

use App\Http\Controllers\Controller;
use App\Models\StoreInventory;
use App\Models\StuffpackList;
use App\Models\Transfer;
use App\Models\TransferList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
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


            DB::transaction(function ($req) use ($request) {

                $transfer = Transfer::create([
                    'source_temp' => $request->source_temp,
                    'destination_temp' => $request->destination_temp,
                    'date' => $request->transfer_date,
                    'trans_num' => $request->transfer_number,
                    'creator_id' => Auth::id(),
                    'modifier_id' => 0
                ]);


                $source_temp = $request->source_temp;
                $destination_temp = $request->destination_temp;

                $transfers = array();
                if (isset($request->stuffs_id)) {
                    $c_stuffs = count($request->stuffs_id);
                    if ($c_stuffs > 0) {
                        for ($i = 0; $i < $c_stuffs; $i++) {

                            // check inventory stuff count
                            $inventory = StoreInventory::where('stuff_id', $request->stuffs_id[$i])->where('tempstore_id',$source_temp)->first();
                            if ($request->stuffs_num[$i] > $inventory->count)
                                return response()->json(['status' => 0, 'msg' => 'تعداد کالای انتقالی بیشتر از موجودی انبار میباشد']);
                            // end check

                            // update Source count store inventory
                            $inventory->count = $inventory->count - $request->stuffs_num[$i];
                            $inventory->save();

                            // update Destination count store inventory
                            $dest_inv = StoreInventory::where('tempstore_id',$destination_temp)->where('stuff_id',$request->stuffs_id[$i])->first();
                            if(!is_null($dest_inv)){
                                $dest_inv->count = $dest_inv->count + $request->stuffs_num[$i];
                                $dest_inv->save();
                            } else {
                                $new_inv = StoreInventory::create([
                                    'tempstore_id' => $destination_temp,
                                    'count' => $request->stuffs_num[$i],
                                    'stuff_id' => $request->stuffs_id[$i],
                                    'stuffpack_id' => 0,
                                    'creator_id' => Auth::id(),
                                    'modifier_id' => Auth::id(),
                                ]);
                            }

                            // end update

                            $transfers[] = [
                                'transfer_id' => $transfer->id,
                                'stuff_id' => $request->stuffs_id[$i],
                                'stuffpack_id' => 0,
                                'count' => $request->stuffs_num[$i],
                            ];
                        }
                    }
                }
                if (isset($request->stuffspack_id)) {
                    $c_stuffspack = count($request->stuffspack_id);
                    if ($c_stuffspack > 0) {
                        for ($i = 0; $i < $c_stuffspack; $i++) {

                            // check inventory count stuffpack
                            $inventory = StoreInventory::where('stuffpack_id', $request->stuffpack_id[$i])->where('tempstore_id',$source_temp)->first();

                            if ($request->stuffspack_num[$i] > $inventory->count)
                                return response()->json(['status' => 0, 'msg' => 'تعداد مجموعه کالای انتقالی بیشتر از موجودی انبار میباشد']);
                            // end check

                            // update Source count store inventory
                            $inventory->count = $inventory->count - $request->stuffspack_num[$i];
                            $inventory->save();

                            // update Destination count store inventory
                            $dest_inv = StoreInventory::where('tempstore_id',$destination_temp)->where('stuffpack_id',$request->stuffpack_id[$i])->first();
                            if(!is_null($dest_inv)){
                                $dest_inv->count = $dest_inv->count + $request->stuffspack_num[$i];
                                $dest_inv->save();
                            } else {
                                $new_inv = StoreInventory::create([
                                    'tempstore_id' => $destination_temp,
                                    'count' => $request->stuffspack_num[$i],
                                    'stuff_id' => 0,
                                    'stuffpack_id' => $request->stuffspack_id[$i],
                                    'creator_id' => Auth::id(),
                                    'modifier_id' => Auth::id(),
                                ]);
                            }

                            // end update

                            $source_inv = StoreInventory::

                            $transfers[] = [
                                'transfer_id' => $transfer->id,
                                'stuff_id' => 0,
                                'stuffpack_id' => $request->stuffspack_id[$i],
                                'count' => $request->stuffspack_num[$i],
                            ];
                        }
                    }
                }

                // create transfer List
                TransferList::insert($transfers);



            });
        } catch (\Exception $exp) {
            return response(['status' => 0, 'msg' => $exp->getMessage()]);
        }

    }
}
