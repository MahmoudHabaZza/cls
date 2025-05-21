<?php

namespace App\Repositories\Interfaces;

use App\Models\User;
use Illuminate\Http\Request;

interface EnrollmentRepositoryInterface {
    public function  enrollInCourse(User $user, $courseId);
    public function filterEnrollments(Request $request);
}