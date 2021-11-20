<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\General\Message;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'user_contacts';
    protected $fillable = ['uset_id','contact_id'];
    protected $appends = ['unread_count','last_talk'];

    public function user()
    {
        return $this->hasOne(User::class,'id','contact_id');
    }

    public function getUnreadCountAttribute()
    {
        $contact_id = $this->contact_id;
        $unread_count = Message::where(['user_id' => $contact_id, 'receiver_id' => \Auth::user()->id,'is_seen' => 0])->count();
        return $unread_count;
    }

    public function getLastTalkAttribute()
    {

        $contact_id = $this->contact_id;

        $last_talk = Message::where(['user_id' => \Auth::user()->id, 'receiver_id' => $contact_id])
        ->orWhere(function ($q) use ($contact_id) {
            $q->where('user_id', $contact_id);
            $q->where('receiver_id', \Auth::user()->id);
        })
        ->orderBy('id', 'desc')->first();

        return $last_talk;
    }
}

