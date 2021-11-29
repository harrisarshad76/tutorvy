<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrphanBooking extends Model
{

    protected $table = 'rphan_bookings';
    protected $fillable = [
        'uuid',
        'user_id',
        'tutor_id',
        'tutor_id',
        'slot',
        'day',
        'timezone'
    ];

    use HasFactory;
}
