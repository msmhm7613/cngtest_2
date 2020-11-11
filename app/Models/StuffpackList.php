<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StuffpackList extends Model
{
    use HasFactory;

    protected $fillable =[
        'stuffpack_id',
        'stuff_id',
        'stuff_count',
    ];

    public $timestamp = true;
}
