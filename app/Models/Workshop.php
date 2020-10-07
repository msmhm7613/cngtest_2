<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workshop extends Model
{
    use HasFactory;

    protected $rules = [
        'name'      => ['unique', 'required', 'string', 'min:3', 'max:25'],
    ];

    protected $fillable = [

        'name',
        'contractor_id',
        'manager',
        'phone',
        'mobile',
        'address',
        'description',
    ];

    public $timestamps = true;
}
