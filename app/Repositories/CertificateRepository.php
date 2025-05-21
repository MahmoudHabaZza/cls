<?php

namespace App\Repositories;

use App\Models\Certificate;
use App\Models\Course;
use App\Repositories\Interfaces\CertificateRepositoryInterface;

class CertificateRepository implements CertificateRepositoryInterface{
    public function getByUserAndCourse(int $userId, int $courseId)
    {
        return Certificate::where('user_id', $userId)
            ->where('course_id', $courseId)
            ->first();
    }

    public function create(array $data)
    {
        return Certificate::create($data);
    }
}