<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempReciept extends Model
{
    use HasFactory;

    protected $fillable = [
        'stuffpack_id',
        'count'
    ];

    public $timestamp = true;
}
