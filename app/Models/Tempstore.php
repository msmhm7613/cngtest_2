<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tempstore extends Model
{
    use HasFactory;

    protected $table = 'tempstores';
    protected $fillable = [
        'name' ,
        'manager',
        'code',
        'phone',
        'mobile',
        'address',
        'desription',
    ];

    public $timestamps = true;
}
