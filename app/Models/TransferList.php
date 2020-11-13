<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferList extends Model
{
    use HasFactory;
    protected $fillable = [
        'transfer_id',
    ];
}
