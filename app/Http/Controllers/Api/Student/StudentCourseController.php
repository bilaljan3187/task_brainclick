<?php

namespace App\Http\Controllers\Api\Student;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\StudentCourse;
use App\Http\Controllers\Controller;
use App\Http\Requests\StudentCourseRequest;
use App\Models\CourseUser;

class StudentCourseController extends Controller
{
    public function subscribe(StudentCourseRequest $request){

        $check = CourseUser::where(['user_id'=>$request->user()->id,'course_id' => $request->course])->get();
        if(count($check) > 0){
            $message['message'] = "Your are already subscribed to course";
        }else{
            $subscribe = CourseUser::create([
                'user_id' => $request->user()->id,
                'course_id' => $request->course
            ]);
            $message['message'] = "Course Added to Your List";

        }

        $course_list = User::where('id',$request->user()->id)->with('courses')->get();

        return response()->json([
            $message,
            "course_list" => $course_list
        ]);
    }


    public function list(Request $request){
        $course_list = User::where('id',$request->user()->id)->with('courses')->get();
        return response()->json([
            "course_list" => $course_list
        ]);
    }
}
