<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $fillable  = ['grade'];

    protected $casts = [
        'created_at' => 'datetime:d-M-y',
    ];
}
