<?php

namespace App\Repositories\Interfaces;

use App\Models\User;

interface EnrollmentRepositoryInterface {
    public function enrollInCourse(User $user,$courseId);
}