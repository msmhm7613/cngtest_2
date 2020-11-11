<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempRecieptList extends Model
{
    use HasFactory;

    protected $fillable = [
        'reciept_id',
        'stuffpack_id',
        'stuff_id',
        'count',
        'comment',
    ];
}
