<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SessionCompletionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user_id' => $this->user_id,
            'session_id' => $this->course_session_id,
            'completed_at' => $this->completed_at,
            "session_name" => $this->courseSession->name,
            "course_id" => $this->courseSession->week->course->id,
            "course_name" => $this->courseSession->week->course->name
        ];
    }
}
