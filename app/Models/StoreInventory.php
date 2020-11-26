<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreInventory extends Model
{
    use HasFactory;
    protected $fillable = [
        'tempstore_id',
        'count',
        'stuff_id',
        'stuffpack_id',
        'creator_id',
        'modifier_id'
    ];
}
