<?php

namespace App\Http\Controllers\StoreInventory;

use App\Http\Controllers\Controller;
use App\Models\StoreInventory;
use App\Models\Stuff;
use App\Models\Stuffpack;
use App\Models\StuffpackList;
use App\Models\Unit;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function get_inventory($temp_id)
    {
        $inventories = StoreInventory::where('tempstore_id', $temp_id)->where('count', '>', 0)->get();
        if (count($inventories)) {
            
            $stuffs = array();
            $packs = array();
            foreach ($inventories as $item) {

                $pack_id = $item->stuffpack_id;
                $stuff_id = $item->stuff_id;

                if ($pack_id != 0) {

                    $stuffpack = Stuffpack::findOrFail($item->stuffpack_id);

                    $packs[] = [
                        'count' => $item->count,
                        'name' => $stuffpack->name,
                        'id' => $stuffpack->id,
                        'code' => $stuffpack->code,

                    ];

                } elseif ($stuff_id != 0) {

                    $stuff = Stuff::findOrFail($stuff_id);
                    $unit = Unit::find($stuff->id)->select('name')->first();
                    $stuffs[] = [
                        'count' => $item->count,
                        'name' => $stuff->name,
                        'id' => $stuff->id,
                        'code' => $stuff->code,
                        'unit' => $unit->name,

                    ];

                } else {
                    return response()->json(['status' => 0, 'msg' => 'مشکلی در موجودی انبار انتخابی وجود دارد !']);
                }

            }

            return response()->json(['status' => 1, 'stuffs' => $stuffs, 'stuffpacks' => $packs]);
        } else
            return response()->json(['status' => 0, 'msg' => 'انبار انتخابی هیچ کالا و یا مجموعه کالایی ندارد']);
    }
}
