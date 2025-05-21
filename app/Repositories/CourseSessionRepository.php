<?php

namespace App\Repositories;

use App\Models\CourseSession;
use App\Repositories\Interfaces\CourseSessionRepositoryInterface;
use Illuminate\Support\Facades\Response;

class CourseSessionRepository implements CourseSessionRepositoryInterface{
    public function getWeek($coureSessionId){
        $session = CourseSession::find($coureSessionId);
        if(!$session)return Response::errorResponse('Not Found',404);
        return $session->week;
    }
    public function getAll()
    {
        return CourseSession::paginate();
    }
    public function getById($id){
        $courseSession = CourseSession::findOrFail($id);
        return $courseSession;
    }
    public function create($data){
        $weekId = $data['week_id'];
        $lastWeekCourseOrder = CourseSession::where('week_id', $weekId)->max('order');
        $newOrder = $lastWeekCourseOrder ? $lastWeekCourseOrder + 1 : 1;
        return CourseSession::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'available' => $data['available'],
            'order' => $newOrder,
            'week_id' => $weekId
        ]);
    }
    public function update($id,$data){
        $courseSession = CourseSession::findOrFail($id)->update($data);
        return $courseSession;
    }
    public function delete($id){
        $courseSession = CourseSession::findOrFail($id)->delete();
        return $courseSession;
    }
}