<?php

namespace App\Repositories;

use App\Models\Week;
use App\Repositories\Interfaces\WeekRepositoryInterface;
use Illuminate\Support\Facades\Response;

class WeekRepository implements WeekRepositoryInterface
{
  
    public function getCourse($weekId){
        $week = Week::find($weekId);
        if(!$week)return Response::errorResponse('Week Not Found',404);
        return $week->course;
    }
    public function getSessions($weekId)
    {
        $week = Week::find($weekId);
        if(!$week)return Response::errorResponse('Week Not Found',404);
        return $week->courseSessions;
    }
    public function getAll()
    {
        return Week::paginate();
    }
    public function getById($id)
    {
        $week = Week::findOrFail($id);
        return $week;
    }
    public function create($data)
    {
        $courseId = $data['course_id'];
        $lastWeekCourseOrder = Week::where('course_id', $courseId)->max('order');
        $newOrder = $lastWeekCourseOrder ? $lastWeekCourseOrder + 1 : 1;
        return Week::create([
            'title' => $data['title'],
            'study_plan_file' => $data['study_plan_file'],
            'order' => $newOrder,
            'week_number' => $data['week_number'],
            'course_id' => $courseId
        ]);
    }
    public function update($id, $data)
    {
        $week = Week::findOrFail($id)->update($data);
        return $week;
    }
    public function delete($id)
    {
        $week = Week::findOrFail($id)->delete();
        return $week;
    }
}
