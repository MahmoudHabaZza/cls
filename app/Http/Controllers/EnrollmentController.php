<?php

namespace App\Http\Controllers;

use App\Http\Requests\EnrollmentOverviewRequest;
use App\Models\CourseSession;
use App\Models\Enrollment;
use App\Models\Week;
use App\Services\EnrollmentService;
use App\Services\SessionCompletionService;
use App\Services\WeekService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class EnrollmentController extends Controller
{
    public function __construct(public EnrollmentService $service, public SessionCompletionService $sessionCompletionService,public WeekService $weekService) {}
    public function enrollCourse($courseId)
    {
        $this->service->enrollAuthenticatedUserToCourse($courseId);
        return Response::apiResponse([], "Enrolled Successfully", 200);
    }

    public function getEnrolledCourses()
    {
        $user = Auth::user();
        return Response::respondCollection('CourseResource', $user->courses);
    }
    public function getAvailableSessions($weekId)
    {
        $userId = Auth::id();

        $result = $this->service->getAvailableSessions($weekId, $userId);

        if ($result instanceof \Illuminate\Http\JsonResponse) {
            return $result; // error was handled in service
        }

        return Response::respondCollection('CourseSessionResource', $result);
    }

    public function checkEnrollmentStatus($courseId)
    {
        $userId = Auth::id();

        $isEnrolled = $this->service->checkEnrollment($userId, $courseId);

        return Response::apiResponse([
            'enrolled' => $isEnrolled,
            'message' => $isEnrolled
                ? 'You are enrolled in this course.'
                : 'You are not enrolled in this course.'
        ]);
    }
    public function search(EnrollmentOverviewRequest $request)
    {

        $enrollments = $this->service->searchEnrollments($request);
        return Response::respondCollection('EnrollmentResource', $enrollments);
    }

    public function completeSession($sessionId)
    {
        $userId = Auth::user()->id;
        $result = $this->sessionCompletionService->completeSession($userId, $sessionId);

        if ($result instanceof \Illuminate\Http\JsonResponse) {
            return $result;
        }

        return Response::apiReponse($result, "Session Marked as Completed");
    }
    public function getWeeksForUser($courseId)
    {
        $userId = Auth::user()->id;

        $weeks = $this->weekService->getWeeksForUser($userId, $courseId);

        if ($weeks instanceof JsonResponse) {
            return $weeks; // error response
        }

        return Response::respondCollection('WeekResource',$weeks);
    }

    public function getCompletedSessions(){
        $userId = Auth::user()->id;
        $completedSessions = $this->sessionCompletionService->getCompletedSessions($userId);
        return Response::respondCollection('SessionCompletionResource',$completedSessions);
    }
}
