<?php

namespace App\Http\Controllers;

use App\Services\EnrollmentService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class EnrollmentController extends Controller
{
    public function __construct(public EnrollmentService $service) {
    }
    public function enrollCourse($courseId){
        $this->service->enrollAuthenticatedUserToCourse($courseId);
        return Response::apiResponse([],"Enrolled Successfully",200);
    }
}
