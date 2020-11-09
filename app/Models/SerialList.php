<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SerialList extends Model
{
    use HasFactory;

    protected $fillable =[
        'stuff_id',
        'rec_id',
        'serial',
    ];

    public $timestamp = true;
}
