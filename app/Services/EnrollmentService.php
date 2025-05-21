<?php

namespace App\Services;

use App\Repositories\Interfaces\EnrollmentRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function searchEnrollments(Request $request)
    {
        return $this->repository->filterEnrollments($request);
    }
}
