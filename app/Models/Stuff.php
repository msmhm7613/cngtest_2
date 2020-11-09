<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stuff extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'latin_name',
        'has_unique_serial',
        'unit',
        'creator_user_id',
        'modifier_user_id',
        'description'
    ];

    public function tempReciepts()
    {
        return $this->belongsTo(TempReciept::class);
    }

    public $timestamps = true;
}
