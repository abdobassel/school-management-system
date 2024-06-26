<?php

namespace App\Providers;

use App\Repository\FeeRepository;
use App\Repository\ExamRepository;
use App\Repository\FeesRepository;
use App\Repository\QuizzRepository;
use App\Repository\LibraryRepository;
use App\Repository\StudentRepository;
use App\Repository\SubjectRepository;
use App\Repository\TeacherRepository;
use App\Repository\QuestionRepository;
use App\Repository\GraduatedRepository;
use App\Repository\PromotionRepository;
use Illuminate\Support\ServiceProvider;
use App\Repository\AttendanceRepository;
use App\Repository\FeeInvoiceRepository;
use App\Repository\FeeRepositoryInterface;
use App\Repository\ExamRepositoryInterface;
use App\Repository\QuizzRepositoryInterface;
use App\Repository\ReceiptStudentRepository;
use App\Repository\StudentAccountRepository;
use App\Repository\LibraryRepositoryInterface;
use App\Repository\StudentRepositoryInterface;
use App\Repository\SubjectRepositoryInterface;
use App\Repository\TeacherRepositoryInterface;
use App\Repository\QuestionRepositoryInterface;
use App\Repository\GraduatedRepositoryInterface;
use App\Repository\PromotionRepositoryInterface;
use App\Repository\AttendanceRepositoryInterface;
use App\Repository\FeeInvoiceRepositoryInterface;
use App\Repository\ReceiptStudentRepositoryInterface;
use App\Repository\StudentAccountRepositoryInterface;

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
        $this->app->bind(
            FeeInvoiceRepositoryInterface::class,
            FeeInvoiceRepository::class,

        );
        $this->app->bind(
            StudentAccountRepositoryInterface::class,
            StudentAccountRepository::class,

        );
        $this->app->bind(
            ReceiptStudentRepositoryInterface::class,
            ReceiptStudentRepository::class,

        );
        $this->app->bind(
            AttendanceRepositoryInterface::class,
            AttendanceRepository::class,

        );
        $this->app->bind(
            SubjectRepositoryInterface::class,
            SubjectRepository::class,

        );
        $this->app->bind(
            ExamRepositoryInterface::class,
            ExamRepository::class,

        );
        $this->app->bind(
            QuizzRepositoryInterface::class,
            QuizzRepository::class,

        );
        $this->app->bind(
            QuestionRepositoryInterface::class,
            QuestionRepository::class,

        );
        $this->app->bind(
            LibraryRepositoryInterface::class,
            LibraryRepository::class,

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
