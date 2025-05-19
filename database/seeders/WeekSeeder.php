<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Week;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WeekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = Course::get();

        foreach($courses as $course){
            for($i = 1;$i <= rand(5,30);$i++){
                Week::create([
                    'title' => fake()->sentence(5),
                    'study_plan_file' => fake()->url(),
                    'order' => $i,
                    'week_number' => $i,
                    'course_id' => $course->id,
                ]);
            }
        }
    }
}
