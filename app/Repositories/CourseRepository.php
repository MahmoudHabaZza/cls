<?php

namespace App\Repositories;

use App\Models\Course;
use App\Models\Week;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use Illuminate\Support\Facades\Response;

class CourseRepository implements CourseRepositoryInterface{
    public function getWeeks($courseId)
    {
        $course = Course::find($courseId);
        if(!$course) return Response::errorResponse('Not Found',404);
        return $course->weeks()->paginate();

    }
    public function getAll()
    {
        return Course::paginate();
    }
    public function getById($id){
        $course = Course::findOrFail($id);
        return $course;
    }
    public function create($data){
        return Course::create($data);
    }
    public function update($id,$data){
        $course = Course::findOrFail($id)->update($data);
        return $course;
    }
    public function delete($id){
        $course = Course::findOrFail($id)->delete();
        return $course;
    }
}