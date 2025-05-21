<?php

namespace App\Services;

use App\Models\CourseSession;
use App\Models\Enrollment;
use App\Models\Week;
use App\Repositories\Interfaces\EnrollmentRepositoryInterface;
use App\Repositories\Interfaces\repositoryInterface;
use App\Repositories\Interfaces\SessionCompletionRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class EnrollmentService
{
    public function __construct(public EnrollmentRepositoryInterface $repository)
    { // model binding => service container
    }
    public function enrollAuthenticatedUserToCourse($courseId)
    {
        $user = Auth::user();
        $this->repository->enrollInCourse($user, $courseId);
    }

    public function getAvailableSessions(int $weekId, int $userId)
    {
        $week = Week::findOrFail($weekId);
        $course = $week->course;

        $isUserEnrolled = $this->repository->getEnrollment($userId, $course->id);

        if (!$isUserEnrolled) {
            return Response::errorResponse("You Are Not Enrolled In This Course! Please Enroll to view sessions");
        }

        $sessions = $week->courseSessions()->where('available', 1)->get();

        if ($sessions->isEmpty()) {
            return Response::errorResponse("No Available Sessions For This Week!", 404);
        }

        return $sessions;
    }

    public function checkEnrollment(int $userId, int $courseId)
    {
        $isEnrolled = $this->repository->isUserEnrolledInCourse($userId, $courseId);

        return $isEnrolled;
    }

    public function searchEnrollments(Request $request)
    {
        return $this->repository->filterEnrollments($request);
    }
   
}
