<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stuffpack extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'serial',
        'description',
        'creator_user_id',
        'modifier_user_id',
    ];

    protected $timestamp = true; 
}
