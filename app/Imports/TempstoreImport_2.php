<?php

namespace App\Imports;

use App\Models\Tempstore;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;


class TempstoreImport_2 implements ToModel, SkipsOnFailure, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        
        
        return new Tempstore([
            //
            'name'          => $row[2],
            'code'          => $row[0] ?? "نامشخص",
            'manager'       => $row[3] ?? "نامشخص",
            'phone'         => $row[4] ?? "00000",
            'mobile'        => $row[5] ?? "00000",
            'address'       => $row[6] ?? "نامشخص",
            'description'   => $row[7] ?? "نامشخص",
        ]); 
    }

    public function onFailure(Failure ...$failure)
    {
        

    }

    public function rules() : array
    {
        return [
            '*.code' => ['unique:tempstores,code'],
            '*.name' => ['unique:tempstores,name'],
        ];
    } 
}
