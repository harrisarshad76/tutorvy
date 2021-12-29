<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Course;
use App\Models\CourseClass;
use App\Models\Classroom;

class CourseClassses extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:create_class';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $courses = Course::where('status',1)->get();
 
        foreach($courses as $course){
            $class = CourseClass::where('course_id',$course->id)->orderBy('class_date','asc')->first();
            if($class->class_status == 0){

                $classroom_id = sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
                    mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
                    mt_rand( 0, 0xffff ),
                    mt_rand( 0, 0x0C2f ) | 0x4000,
                    mt_rand( 0, 0x3fff ) | 0x8000,
                    mt_rand( 0, 0x2Aff ), mt_rand( 0, 0xffD3 ), mt_rand( 0, 0xff4B )
                );
                Classroom::where('course_id',$course->id)->delete();
                $class_room = new Classroom();
                $class_room->type = 'course_class';
                $class_room->course_id = $course->id;
                $class_room->classroom_id = $classroom_id;
                $class_room->save();
            }

        }
    }
}
