<?php

namespace App\Models;

use App\Models\Admin\Subject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Classroom;
use Illuminate\Support\Carbon;
use App\Models\Payments;
class Booking extends Model
{
    use HasFactory;

      /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'uuid',
        'booked_tutor',
        'subject_id',
        'topic',
        'question',
        'brief',
        'attachments',
        'class_date',
        'class_time',
        'class_booked_till',
        'server_time', 
        'status',
        'duration',
        'cancel_note',
        'reschedule_note',
        'price',
        'student_review',
        'rating',
        'is_reviewed',
    ];

    protected $appends = ['class_tm' ,'class_end_tm'];

    public function getClassTmAttribute() {

        $tm = $this->class_date .' '. $this->class_time;
        $date = new \DateTime($tm, new \DateTimeZone(auth()->user()->time_zone));
        $region_offset = $date->getOffset();

        $a = $date->format('Y-m-d H:i:s P');


        if(strpos($a , "+")) {
            $bk_time = Carbon::parse($tm)->addSeconds($region_offset)->format('H:i');
        }else if(strpos($a , "-")){
            $bk_time = Carbon::parse($tm)->subSeconds($region_offset)->format('H:i');
        }

        return $this->attributes['class_tm'] = $bk_time;
    }

    public function getClassEndTmAttribute() {

        $tm = $this->class_date .' '. $this->class_time;
        $date = new \DateTime($tm, new \DateTimeZone(auth()->user()->time_zone));
        $region_offset = $date->getOffset();

        $a = $date->format('Y-m-d H:i:s P');


        if(strpos($a , "+")) {
            $bk_end_time = Carbon::parse($tm)->addSeconds($region_offset)->addSeconds(3600)->format('H:i');
        }else if(strpos($a , "-")){
            $bk_end_time = Carbon::parse($tm)->subSeconds($region_offset)->addSeconds(3600)->format('H:i');
        }


        return $this->attributes['class_end_tm'] = $bk_end_time ;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
    public function tutor()
    {
        return $this->belongsTo(User::class,'booked_tutor');
    }

    public function classroom()
    {
        return $this->hasOne(Classroom::class,'booking_id','id');
    }

    public function booking_payment()
    {
        return $this->hasOne(Payments::class,'type_id','id');
    }

    public function payment()
    {
        return $this->hasMany(Payments::class,'type_id','id');
    }

    // Scopes for Filteration
    public function scopeToday($query)
    {
        return $query->where(DB::raw('CAST(created_at as date)'),date('Y-m-d'));

    }
    public function scopeTomorrow($query)
    {
        return $query->where(DB::raw('Date(created_at)'),'<=','"'.date('Y-m-d',strtotime($this->created_at."+1 d")).'"');
    }
    public function scopeStatus($query,$status)
    {
        return $query->where('status',$status);
    }
}
