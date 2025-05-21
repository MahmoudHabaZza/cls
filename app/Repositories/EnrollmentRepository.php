<?php

namespace App\Repositories;

use App\Models\Enrollment;
use App\Models\User;
use App\Repositories\Interfaces\EnrollmentRepositoryInterface;

class EnrollmentRepository implements EnrollmentRepositoryInterface{
    public function enrollInCourse(User $user, $courseId)
    {
        $user->courses()->syncWithoutDetaching([
            $courseId => [
                'enrolled_at' => now(),
                'progress' => 0
            ]
        ]);
    }
}