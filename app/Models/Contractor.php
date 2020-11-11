<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contractor extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'name' ,
        'manager',
        'description',
    ];

    protected $rules = [
        'name' => ['string','alpha', 'required', 'min:3', 'max:25'],
        'manager' => ['string','alpha', 'min:3', 'max:25'],
        'description' => ['nullable'],
    ];

    public $timestamps = true;
}
