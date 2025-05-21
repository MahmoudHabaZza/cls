<?php

namespace App\Services;

use App\Repositories\Interfaces\WeekRepositoryInterface;

class WeekService {
    public function __construct(public WeekRepositoryInterface $repository) { // model binding => service container
    }
    public function getCourse($weekId){
        return $this->repository->getCourse($weekId);
    }
    public function getSessions($weekId){
        return $this->repository->getSessions($weekId);
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