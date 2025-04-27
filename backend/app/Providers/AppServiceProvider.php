<?php

namespace App\Providers;

use App\Contracts\Repositories\BaseRepository as BaseRepositoryContract;
use App\Contracts\Repositories\UserRepository as UserRepositoryContract;
use App\Contracts\Services\UserService as UserServiceContract;
use App\Repositories\BaseRepository;
use App\Repositories\UserRepository;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
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
}
