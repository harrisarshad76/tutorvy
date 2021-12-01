<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassMessages extends Model
{
    use HasFactory;

    protected $table = "class_messages";

    protected $fillable = ['message','user_id','receiver_id','type','is_seen'];
}
