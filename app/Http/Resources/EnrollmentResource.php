<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EnrollmentResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id, // ID from the pivot (if you use a pivot model)
            'enrolled_at' => $this->enrolled_at?->toDateTimeString(),
            'progress' => $this->progress,
            
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
                'email' => $this->user->email,
                'enrolled_courses_count' => $this->user->courses()->count()
            ],

            'course' => [
                'id' => $this->course->id,
                'name' => $this->course->name,
                'level' => $this->course->level,
                'price' => $this->course->price,
                'thumbnail' => $this->course->thumbnail,
                'sessions_count' => $this->course->sessions_count,
                'enrolled_users_count' => $this->course->users()->count()
            ],
        ];
    }
}
