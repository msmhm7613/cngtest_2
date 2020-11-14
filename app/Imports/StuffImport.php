<?php

namespace App\Imports;

use App\Models\Stuff;
use Maatwebsite\Excel\Concerns\ToModel;

class StuffImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Stuff([
            'code' => $row[0],
            'name' => $row[1],
            'latin_name' => $row[2],
            'has_unique_serial' => $row[3],
            'creator_user_id' => auth()->id(),
            'modifier_user_id' => auth()->id(),
            'unit_id' => $row,
            'description' => $row[5],
        ]);
    }
}
