<?php

namespace App\Repositories\Interfaces;

use App\Models\User;

interface CertificateRepositoryInterface {
    public function getByUserAndCourse(int $userId, int $courseId);
    public function create(array $data);
}