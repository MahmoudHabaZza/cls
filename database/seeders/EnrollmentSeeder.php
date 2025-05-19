<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EnrollmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = Course::get();
        User::all()->each(function($user) use ($courses){
            $randomCourses = $courses->shuffle()->take(rand(3,6));
            $attachments = [];
            foreach($randomCourses as $course){
                $attachments[$course->id] = [
                    'enrolled_at' => Carbon::now()->subDays(rand(0,30)),
                    'progress' => rand(1,100)
                ];
            }
            $user->courses()->syncWithoutDetaching($attachments);
        });
    }
}
