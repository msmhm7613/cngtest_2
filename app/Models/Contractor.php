<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contractor extends BaseModel
{
    use HasFactory;

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    protected $fillable = [
        'name' ,
        'description',
    ];

    protected $rules = [
        'name' => ['string','alpha', 'required', 'min:3', 'max:25'],
        'description' => ['nullable']
    ];
}
