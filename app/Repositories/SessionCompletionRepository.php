<?php

namespace App\Repositories;

use App\Models\SessionCompletion;
use App\Repositories\Interfaces\SessionCompletionRepositoryInterface;
use Carbon\Carbon;

class SessionCompletionRepository implements SessionCompletionRepositoryInterface{
    public function markSessionAsCompleted(int $userId, int $sessionId)
    {
        return SessionCompletion::updateOrCreate(
            [
                'user_id' => $userId,
                'course_session_id' => $sessionId,
            ],
            [
                'completed_at' => Carbon::now(),
            ]
        );
    }

    public function getCompletedSessions($userId){
        return SessionCompletion::where('user_id',$userId)->get();
    }
}