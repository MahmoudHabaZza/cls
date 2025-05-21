<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseSessionRequest;
use App\Models\CourseSession;
use App\Services\CourseSessionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class CourseSessionController extends Controller
{
    public function __construct(public CourseSessionService $service)
    {
        
    }

    public function getWeek($courseSesionId){
        return Response::respondSingleCollection('WeekResource',$this->service->getWeek($courseSesionId));
    }

    public function index()
    {
        return Response::respondCollection('CourseSessionResource',$this->service->getAll());
    }

    

    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseSessionRequest $request)
    {
        return Response::createdResponse('CourseSessionResource',$this->service->create($request->validated()));
    }

    /**
     * Display the specified resource.
     */
    public function show(CourseSession $courseSession)
    {
        return Response::respondSingleCollection('CourseSessionResource',$this->service->getById($courseSession->id));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(CourseSessionRequest $request, CourseSession $courseSession)
    {
        $this->service->update($courseSession->id,$request->validated());
        return Response::respondNoContent("Updated Successfully!");
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourseSession $courseSession)
    {
        $this->service->delete($courseSession->id);
        return Response::respondNoContent("Deleted Successfully!");
    }
}
