<?php

namespace App\Repositories\Interfaces;

interface CourseSessionRepositoryInterface {
    public function getWeek($coureSessionId);
    public function getAll();
    public function getById($id);
    public function create($data);
    public function update($id,$data);
    public function delete($id);
}