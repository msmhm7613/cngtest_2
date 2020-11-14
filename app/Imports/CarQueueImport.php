<?php

namespace App\Imports;

use App\Models\CarQueue;
use Maatwebsite\Excel\Concerns\ToModel;

class CarQueueImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new CarQueue([
            'track_number' => $row[0],
            'turn_date' => $row[1],
            'status' => $row[2],
            'owner_name' => $row[3],
            'owner_id' => $row[4],
            'owner_phone' => $row[5],
            'tag' => $row[6],
            'car_type' => $row[7],
            'car_brand' => $row[8],
            'car_model' => $row[9],
            'state' => $row[10],
            'city' => $row[11],
            'contractor' => $row[12],
            'workshop' => $row[13],
            'workshop_state' => $row[14],
            'workshop_city' => $row[15],
            'workshop_address' => $row[16],
            'workshop_phone' => $row[17],
            'convert_date' => $row[18],
            'convert_id'=>$row[19],
            'tank_size' => $row[20],
            'tank_id' => $row[21],
            'tank_valve' => $row[22],
            'regulator_id' => $row[23],
            'convert_certificate_id' => $row[24],
            'health_certificate_id' => $row[25],
            'engine_id' => $row[26],
        ]);
    }
}
