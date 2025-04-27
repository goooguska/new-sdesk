<?php

namespace App\Providers;

use App\Contracts\Mailer as MailerContract;
use App\Contracts\Repositories\BaseRepository as BaseRepositoryContract;
use App\Contracts\Repositories\UserRepository as UserRepositoryContract;
use App\Contracts\Services\UserService as UserServiceContract;
use App\Mail\Mailer;
use App\Repositories\BaseRepository;
use App\Repositories\UserRepository;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->registerUtils();
        $this->registerRepositories();
        $this->registerServices();
    }

    public function boot(): void
    {
        //
    }

    private function registerRepositories(): void
    {
        $this->app->bind(
            BaseRepositoryContract::class,
            BaseRepository::class
        );

        $this->app->bind(
            UserRepositoryContract::class,
            UserRepository::class
        );
    }

    private function registerServices(): void
    {
        $this->app->bind(
            UserServiceContract::class,
            UserService::class
        );
    }

    private function registerUtils(): void
    {
        $this->app->bind(
            MailerContract::class,
            Mailer::class
        );
    }
}
