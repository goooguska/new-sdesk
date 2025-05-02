<?php

namespace App\Providers;

use App\Contracts\Mailer as MailerContract;
use App\Contracts\Repositories\BaseRepository as BaseRepositoryContract;
use App\Contracts\Repositories\UserRepository as UserRepositoryContract;
use App\Contracts\Services\AuthService as AuthServiceContract;
use App\Contracts\Services\SessionService as SessionServiceContract;
use App\Mail\Mailer;
use App\Repositories\BaseRepository;
use App\Repositories\UserRepository;
use App\Services\AuthService;
use App\Services\SessionService;
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
            AuthServiceContract::class,
            AuthService::class
        );

        $this->app->bind(
            SessionServiceContract::class,
            SessionService::class
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
