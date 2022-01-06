<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Admin\Subject;
use App\Models\Admin\SubjectCategory;
use App\Models\Course;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Admin -- SubjectController
    |--------------------------------------------------------------------------
    |
    | This controller handles Subject from admin side
    |
    |
    */

    public function index()
    {
        $subjects = Subject::paginate(150);
        $categories = SubjectCategory::get();

        return view('admin.pages.subjects.index',compact('subjects','categories'));
    }

    public function getSubjectsFromApi(){
        $categories = json_decode(Http::get('https://tutorme.com/api/v1/categoriesgroups/?all=true'),true);
        // return $categories;
        foreach($categories as $category){
            $subject_category = SubjectCategory::create([
                'name' => $category['name'],
                'status' => 1
            ]);
            foreach($category['categories'] as $sub_cat ){
                $subject = Subject::create([
                    'category_id' => $subject_category->id,
                    'name' => $sub_cat['name'],
                    'slug' => $sub_cat['slug']
                ]);
            }
        }
        return "added Subjects" ;
    }

    public function insertSubject(Request $request){
        $subject = Subject::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
        ]);

        return response()->json([
            'status'=>'200',
            'message' => 'Subject Added.'
        ]);


    }

    public function deleteSubject(Request $request){


        $subject = Subject::destroy([
            'id' => $request->id,
        ]);

        return response()->json([
            'status'=>'200',
            'message' => 'Subject Deleted.'
        ]);


    }

    public function updateSubject(Request $request){
        // console.log($request->name);
        $subject = Subject::where('id',$request->id)->update([
            'name' => $request->name,
            'category_id' => $request->category_id,

        ]);

        return response()->json([
            'status'=>'200',
            'message' => 'Subject Updated.'
        ]);


    }


    public function status(Request $request)
    {
        try{
            $subject = Subject::where('id',$request->id)->update([
                'status' => $request->status
            ]);

            $message = '';

            if($subject == 1){
                if($request->status == 1){
                    $message = 'Subject Enabled Successfully!';
                }else{
                    $message = 'Subject Disabled Successfully!';
                }
            }

            return response()->json([
                'status'=>'200',
                'message' => $message,
            ]);

        }catch(Exception $e){
            return response()->json([
                'status'=>'400',
                'message' => $e->getMessage()
            ]);
        }


    }




}
