<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GradesOffered extends Model
{
        protected $fillable = [ 'grade_offered' ];

        protected $casts = [
        'created_at' => 'datetime:d-M-y',
        ];
}
