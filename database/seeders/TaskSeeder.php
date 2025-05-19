<?php

namespace Database\Seeders;

use App\Models\CourseSession;
use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sessionIds = CourseSession::inRandomOrder()->limit(300)->pluck('id');

        foreach($sessionIds as $sessionId){
            for($i = 1;$i <= rand(2,4);$i++){
                Task::create([
                    'title' => fake()->sentence(5),
                    'order' => $i,
                    'description' => fake()->sentence(10),
                    'course_session_id' => $sessionId
                ]);
            }
        }
    }
}
