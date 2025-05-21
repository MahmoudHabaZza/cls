<?php

namespace App\Services;

use App\Repositories\Interfaces\EnrollmentRepositoryInterface;
use App\Repositories\Interfaces\WeekRepositoryInterface;
use Illuminate\Support\Facades\Response;

class WeekService {
    public function __construct(public WeekRepositoryInterface $repository,public EnrollmentRepositoryInterface $enrollmentRepository) { // model binding => service container
    }
    public function getCourse($weekId){
        return $this->repository->getCourse($weekId);
    }
    public function getSessions($weekId){
        return $this->repository->getSessions($weekId);
    }
    public function getWeeksForUser(int $userId, int $courseId)
    {
        $isEnrolled = $this->enrollmentRepository->isUserEnrolledInCourse($userId, $courseId);

        if (!$isEnrolled) {
            return Response::errorResponse("Your are not enrolled in this course.",403);
        }

        return $this->repository->getByCourseId($courseId);
    }
    public function getAll()
    {
        return $this->repository->getAll();
    }
    public function getById($id){
        return $this->repository->getById($id);
    }
    public function create(array $data){
        return $this->repository->create($data);
    }
    public function update($id,$data){
        return $this->repository->update($id,$data);
    }
    public function delete($id){
        return $this->repository->delete($id);
    }
}