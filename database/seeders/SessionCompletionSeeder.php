<?php

namespace Database\Seeders;

use App\Models\CourseSession;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SessionCompletionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courseSessions = CourseSession::get();
        User::all()->each(function($user) use ($courseSessions){
            $randomCourseSessions = $courseSessions->shuffle()->take(rand(3,6));
            $attachments = [];
            foreach($randomCourseSessions as $session){
                $attachments[$session->id] = [
                    'completed_at' => Carbon::now()->subDays(rand(0,30)),
                ];
            }
            $user->completedCourseSessions()->syncWithoutDetaching($attachments);
        });
    }
}
