<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\Teacher\CourseController;
use App\Http\Controllers\Api\Student\StudentCourseController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->as('v1.')->middleware('auth:sanctum')->group(function(){
    // Route::apiResource('tasks',TaskController::class);
    // teacher routes
    Route::middleware('teacher')->group(function(){
        Route::apiResource('course',CourseController::class);
    });

    // student routes
    Route::middleware('student')->group(function(){
        Route::post('course_subscribe',[StudentCourseController::class,'subscribe']);
        Route::post('student_course_list',[StudentCourseController::class,'list']);
    });
    Route::post('logout',function(){
        return response()->json('hello');
    });

});
Route::get('course_list',[CourseController::class,'index']);
Route::post('register',RegisterController::class);
Route::post('login',LoginController::class);


