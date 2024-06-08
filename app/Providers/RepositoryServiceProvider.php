<?php

namespace App\Providers;

use App\Repository\FeeRepository;
use App\Repository\FeesRepository;
use App\Repository\StudentRepository;
use App\Repository\TeacherRepository;
use App\Repository\GraduatedRepository;
use App\Repository\PromotionRepository;
use Illuminate\Support\ServiceProvider;
use App\Repository\FeeRepositoryInterface;
use App\Repository\StudentRepositoryInterface;
use App\Repository\TeacherRepositoryInterface;
use App\Repository\GraduatedRepositoryInterface;
use App\Repository\PromotionRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            TeacherRepositoryInterface::class,
            TeacherRepository::class,

        );
        $this->app->bind(
            StudentRepositoryInterface::class,
            StudentRepository::class,

        );
        $this->app->bind(
            PromotionRepositoryInterface::class,
            PromotionRepository::class,

        );
        $this->app->bind(
            GraduatedRepositoryInterface::class,
            GraduatedRepository::class,

        );
        $this->app->bind(
            FeeRepositoryInterface::class,
            FeeRepository::class,

        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
