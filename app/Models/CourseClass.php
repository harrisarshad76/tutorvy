<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseClass extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'course_classes';
    protected $fillable = [
        'course_id',
        'class_date', 
        'class_time',
        'class_end_time',
        'class_status',
        'class_title',
        'class_overview'
    ];

}


