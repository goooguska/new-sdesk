<?php

namespace App\Providers;

use App\Contracts\Mailer as MailerContract;
use App\Contracts\Repositories\Admin\CategoryRepository as CategoryRepositoryContract;
use App\Contracts\Repositories\Admin\RoleRepository as RoleRepositoryContract;
use App\Contracts\Repositories\Admin\StatusRepository as StatusRepositoryContract;
use App\Contracts\Repositories\BaseRepository as BaseRepositoryContract;
use App\Contracts\Repositories\UserRepository as UserRepositoryContract;
use App\Contracts\Services\Admin\CategoryService as CategoryServiceContract;
use App\Contracts\Services\Admin\RoleService as RoleServiceContract;
use App\Contracts\Services\Admin\StatusService as StatusServiceContract;
use App\Contracts\Services\AuthService as AuthServiceContract;
use App\Contracts\Services\BaseService as BaseServiceContract;
use App\Contracts\Services\SessionService as SessionServiceContract;
use App\Mail\Mailer;
use App\Repositories\Admin\CategoryRepository;
use App\Repositories\Admin\RoleRepository;
use App\Repositories\Admin\StatusRepository;
use App\Repositories\BaseRepository;
use App\Repositories\UserRepository;
use App\Services\Admin\CategoryService;
use App\Services\Admin\RoleService;
use App\Services\Admin\StatusService;
use App\Services\AuthService;
use App\Services\BaseService;
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

        $this->app->bind(
            CategoryRepositoryContract::class,
            CategoryRepository::class
        );

        $this->app->bind(
            StatusRepositoryContract::class,
            StatusRepository::class
        );

        $this->app->bind(
            RoleRepositoryContract::class,
            RoleRepository::class
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

        $this->app->bind(
            BaseServiceContract::class,
            BaseService::class
        );

        $this->app->bind(
            CategoryServiceContract::class,
            CategoryService::class
        );

        $this->app->bind(
            StatusServiceContract::class,
            StatusService::class
        );

        $this->app->bind(
            RoleServiceContract::class,
            RoleService::class
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
