<?php

namespace App\Repositories\Interfaces;

use App\Models\User;
use Illuminate\Http\Request;

interface EnrollmentRepositoryInterface {
    public function  enrollInCourse(User $user, $courseId);
    public function isUserEnrolledInCourse(int $userId, int $courseId): bool;
    public function getEnrollment(int $userId, int $courseId);
    public function filterEnrollments(Request $request);
}