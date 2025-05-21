<?php

namespace App\Repositories\Interfaces;

interface SessionCompletionRepositoryInterface {
    public function markSessionAsCompleted(int $userId, int $sessionId);
    public function getCompletedSessions($userId);
}