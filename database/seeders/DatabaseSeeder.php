<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CourseSeeder::class,
            WeekSeeder::class,
            CourseSessionSeeder::class,
            TaskSeeder::class,
            EnrollmentSeeder::class,
            CertificateSeeder::class,
            SessionCompletionSeeder::class,
        ]);
    }
}
