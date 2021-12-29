<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Booking;
use App\Models\Admin\Subject;
class Classroom extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'classroom';
    protected $fillable = [
        'booking_id',
        'course_id',
        'classroom_id',
        'course_class_id',
        'type'
    ];
    
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

}


