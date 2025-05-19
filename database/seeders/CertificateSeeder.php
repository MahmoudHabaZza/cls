<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CertificateSeeder extends Seeder
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
                    'certificated_at' => Carbon::now()->subDays(rand(0,30)),
                    'certificate_file_path' => fake()->url()
                ];
            }
            $user->certifiedCourses()->syncWithoutDetaching($attachments);
        });
    }
}
