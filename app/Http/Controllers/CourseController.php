<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
use App\Models\Course;
use App\Services\CourseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class CourseController extends Controller
{

    public function __construct(public CourseService $service) {}

    public function getWeeks($courseId)
    {
        return Response::respondCollection('WeekResource', $this->service->getWeeks($courseId));
    }

    public function index()
    {
        return Response::respondCollection('CourseResource', $this->service->getAll());
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseRequest $request)
    {
        return Response::createdResponse('CourseResource', $this->service->create($request->validated()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        return Response::respondSingleCollection('CourseResource', $this->service->getById($course->id));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(CourseRequest $request, Course $course)
    {
        $this->service->update($course->id, $request->validated());
        return Response::respondNoContent("Updated Successfully!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $this->service->delete($course->id);
        return Response::respondNoContent("Deleted Successfully!");
    }
}
