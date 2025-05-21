<?php

namespace App\Repositories;

use App\Models\Task;
use App\Repositories\Interfaces\TaskRepositoryInterface;

class TaskRepository implements TaskRepositoryInterface
{
    public function getAll()
    {
        return Task::paginate();
    }
    public function getById($id)
    {
        $task = Task::findOrFail($id);
        return $task;
    }
    public function create($data)
    {
        $courseSessionId = $data['course_session_id'];
        $lastTaskOrder = Task::where('course_session_id', $courseSessionId)->max('order');
        $newOrder = $lastTaskOrder ? $lastTaskOrder + 1 : 1;
        return Task::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'order' => $newOrder,
            'course_session_id' => $data['course_session_id']
        ]);
    }
    public function update($id, $data)
    {
        $task = Task::findOrFail($id)->update($data);
        return $task;
    }
    public function delete($id)
    {
        $task = Task::findOrFail($id)->delete();
        return $task;
    }
}
