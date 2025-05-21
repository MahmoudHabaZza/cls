<?php

namespace App\Repositories\Interfaces;

interface WeekRepositoryInterface {
    public function getCourse($weekId);
    public function getSessions($weekId);
    public function getAll();
    public function getById($id);
    public function create($data);
    public function update($id,$data);
    public function delete($id);
}