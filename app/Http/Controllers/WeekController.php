<?php

namespace App\Http\Controllers;

use App\Http\Requests\WeekRequest;
use App\Models\Week;
use App\Services\WeekService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class WeekController extends Controller
{
    public function __construct(public WeekService $service)
    {
        
    }

    public function getCourse($weekId){
        return Response::respondSingleCollection('CourseResource',$this->service->getCourse($weekId));
    }
    public function getSessions($weekId){
        return Response::respondCollection('CourseSessionResource',$this->service->getSessions($weekId));
    }
    public function index()
    {
        return Response::respondCollection('WeekResource',$this->service->getAll());
    }

    

    /**
     * Store a newly created resource in storage.
     */
    public function store(WeekRequest $request)
    {
        return Response::createdResponse('WeekResource',$this->service->create($request->validated()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Week $week)
    {
        return Response::respondSingleCollection('WeekResource',$this->service->getById($week->id));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(WeekRequest $request, Week $week)
    {
        $this->service->update($week->id,$request->validated());
        return Response::respondNoContent("Updated Successfully!");
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Week $week)
    {
        $this->service->delete($week->id);
        return Response::respondNoContent("Deleted Successfully!");
    }
}
