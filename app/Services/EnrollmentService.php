<?php

namespace App\Services;

use App\Repositories\Interfaces\EnrollmentRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class EnrollmentService {
    public function __construct(public EnrollmentRepositoryInterface $repository) { // model binding => service container
    }
    public function enrollAuthenticatedUserToCourse($courseId){
        $user = Auth::user();
        $this->repository->enrollInCourse($user,$courseId);
    }
}