<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $fillable = [ 
        'isApproved',
        'grades_offered',
        'school_name',
        'school_logo',
        'school_branch',
        'education_type',
        'center_number',
        'phone',
        'website',
        'address',
        'area',
        'town',
        'province',
        'country',
        'user_id',
         
    ];

    // protected $with = [
    //     'grade:id,grade_offered',
    // ];

    // public function grades()
    // {
    //     return $this->hasMany('App\Grade','grades_offered');
    // }

    protected $casts = [
        'isApproved' => 'boolean',
        'created_at' => 'datetime:d-M-y',
    ];

}
