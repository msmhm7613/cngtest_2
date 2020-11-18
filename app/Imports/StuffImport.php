<?php

namespace App\Imports;

use App\Models\Stuff;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Validation\Rule;

class StuffImport implements ToModel, SkipsOnFailure,WithValidation
{

    use Importable, SkipsFailures;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Stuff([
            'code' => trim($row[0]),
            'name' => trim($row[1]),
            'latin_name' => trim($row[2]),
            'has_unique_serial' => $row[3] ?? 0,
            'creator_user_id' => auth()->id(),
            'modifier_user_id' => auth()->id(),
            'unit_id' => (trim($row[4]) == "" ) ? "عدد" : trim($row[4]),
            'description' => (trim($row[5]) == "") ?  "ندارد" : trim($row[5]),
        ]);
    }
    public function rules(): array {
        return [ "*.code" => Rule::unique('stuffs,code') ];
    }

}
