<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Message extends Model
{
    use HasFactory;
    protected $fillable=['message','user_id','receiver_id','is_seen'];
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
