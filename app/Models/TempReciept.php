<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempReciept extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender',
        'referral_number',
        'referral_date',
        'stuffpack_id',
        'stuff_id',
        'count',
        'unit_id',
        'comment',
        'driver',
        'car_no',
        'car_type',
        'description',
        'creator_id',
        'confirmer_id',
    ];

    public $timestamp = true;
}
