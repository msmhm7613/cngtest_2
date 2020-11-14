<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    use HasFactory;
    protected $fillable = ['source_temp','destination_temp','date','trans_num','creator_id','modifier_id'];
}
