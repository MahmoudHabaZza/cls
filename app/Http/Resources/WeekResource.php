<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WeekResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->title,
            'study_plan_file' =>$this->study_plan_file,
            'order' => $this->order,
            'week_number' => $this->week_number,
            'course_id' => $this->course_id,
            'course_name' => $this->course->name
        ];
    }
}
