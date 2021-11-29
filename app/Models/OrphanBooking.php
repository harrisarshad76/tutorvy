<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrphanBooking extends Model
{

    protected $table = 'orphan_bookings';
    protected $fillable = [
        'uuid',
        'user_id',
        'tutor_id',
        'date',
        'slot',
        'day',
        'timezone'
    ];

    use HasFactory;
}
