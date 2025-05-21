<?php

namespace App\Providers;

use App\Repositories\CertificateRepository;
use App\Repositories\CourseRepository;
use App\Repositories\CourseSessionRepository;
use App\Repositories\EnrollmentRepository;
use App\Repositories\Interfaces\CertificateRepositoryInterface;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\CourseSessionRepositoryInterface;
use App\Repositories\Interfaces\EnrollmentRepositoryInterface;
use App\Repositories\Interfaces\WeekRepositoryInterface;
use App\Repositories\WeekRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        app()->bind(CourseRepositoryInterface::class,CourseRepository::class);
        app()->bind(WeekRepositoryInterface::class,WeekRepository::class);
        app()->bind(CourseSessionRepositoryInterface::class,CourseSessionRepository::class);
        app()->bind(EnrollmentRepositoryInterface::class,EnrollmentRepository::class);
        app()->bind(CertificateRepositoryInterface::class,CertificateRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
