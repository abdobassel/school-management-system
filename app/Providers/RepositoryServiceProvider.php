<?php

namespace App\Providers;

use App\Repository\StudentRepository;
use App\Repository\TeacherRepository;
use App\Repository\PromotionRepository;
use Illuminate\Support\ServiceProvider;
use App\Repository\StudentRepositoryInterface;
use App\Repository\TeacherRepositoryInterface;
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
