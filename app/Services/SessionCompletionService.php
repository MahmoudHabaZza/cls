<?php

namespace App\Services;

use App\Models\CourseSession;
use App\Models\Enrollment;
use App\Repositories\Interfaces\SessionCompletionRepositoryInterface;
use Illuminate\Support\Facades\Response;

class SessionCompletionService {
    public function __construct(public SessionCompletionRepositoryInterface $repository) { // model binding => service container
    }
    public function completeSession(int $userId, int $courseSessionId)
    {
        $session = CourseSession::with('week.course')->find($courseSessionId);

        if (!$session || !$session->available) {
            return Response::errorResponse("Session not found or not available", 404);
        }

        // Ensure session belongs to a week → belongs to a course
        $course = $session->week->course ?? null;

        if (!$course) {
            return Response::errorResponse("Invalid course relationship.", 400);
        }

        $isEnrolled = Enrollment::where('user_id', $userId)
                                ->where('course_id', $course->id)
                                ->exists();

        if (!$isEnrolled) {
            return Response::errorResponse("You are not enrolled in this course", 403);
        }

        $completion = $this->repository->markSessionAsCompleted($userId, $courseSessionId);

        return $completion;
    }
    public function getCompletedSessions($userId){
        $completedSessions = $this->repository->getCompletedSessions($userId);
        if(!$completedSessions){
            return Response::errorResponse("No Completed Sessions Found",404);
        }
        return $completedSessions;
    }
}