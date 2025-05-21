<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseSessionController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\WeekController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Laravel\Fortify\Http\Controllers\NewPasswordController;
use Laravel\Fortify\Http\Controllers\PasswordResetLinkController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');




// auth routes
Route::post('register',[RegisterController::class,'store'])->name('register');
Route::post('forgot-password',[PasswordResetLinkController::class,'store']);
Route::post('reset-password',[NewPasswordController::class,'store'])->name('password.reset');

Route::middleware('auth:sanctum')->group(function(){

    Route::post('logout',[AuthenticatedSessionController::class,'destroy']);

    Route::get('courses',[CourseController::class,'index']);
    Route::get('courses/{course}',[CourseController::class,'show']);

    // get certificate
    Route::get('certificate/{course_id}',[CertificateController::class,'generate']);

    // enroll a course
    Route::post('enroll-course/{course_id}',[EnrollmentController::class,'enrollCourse']);

    Route::middleware(AdminMiddleware::class)->group(function(){
        Route::apiResource('courses',CourseController::class)->except(['index','show']);
        Route::get('courses/get-weeks/{course_id}',[CourseController::class,'getWeeks']);
    
        Route::apiResource('weeks',WeekController::class);
        Route::get('weeks/get-course/{week_id}',[WeekController::class,'getCourse']);
        Route::get('weeks/get-sessions/{week_id}',[WeekController::class,'getSessions']);
        
        Route::apiResource('course_sessions',CourseSessionController::class);
        Route::get('course_sessions/get-week/{course_session_id}',[CourseSessionController::class,'getWeek']);
    });
});