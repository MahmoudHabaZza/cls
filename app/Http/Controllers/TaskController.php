<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
class TaskController extends Controller
{

    public function __construct(public TaskService $service)
    {
        
    }
    public function index()
    {
        return Response::respondCollection('TaskResource',$this->service->getAll());
    }

    

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)
    {
        return Response::createdResponse('TaskResource',$this->service->create($request->validated()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return Response::respondSingleCollection('TaskResource',$this->service->getById($task->id));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, Task $task)
    {
        $this->service->update($task->id,$request->validated());
        return Response::respondNoContent("Updated Successfully!");
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $this->service->delete($task->id);
        return Response::respondNoContent("Deleted Successfully!");
    }
}
