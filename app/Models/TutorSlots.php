<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TutorSlots extends Model
{
    protected $table = 'tutor_slots';
    protected $fillable = [
        'user_id',
        'day',
        'wrk_from',
        'wrk_to',
        'slot_length',
        'bk_pr_slot',
        'day_off',
    ];


    use HasFactory;
}
