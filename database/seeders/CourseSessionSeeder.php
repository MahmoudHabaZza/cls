<?php

namespace Database\Seeders;

use App\Models\CourseSession;
use App\Models\Week;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $weekIds = Week::pluck('id');
        foreach($weekIds as $weekId){
            for($i = 1;$i <= rand(3,7);$i++){
                CourseSession::create([
                    'name' => fake()->sentence(5),
                    'description' => fake()->sentence(10),
                    'order' => $i,
                    'available' => fake()->boolean(),
                    'week_id' => $weekId
                ]);
            }
        }
    }
}
