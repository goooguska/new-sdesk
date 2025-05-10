<?php

namespace App\Providers;

use App\Contracts\Mailer as MailerContract;
use App\Contracts\Repositories\Admin\CategoryRepository as CategoryRepositoryContract;
use App\Contracts\Repositories\Admin\RoleRepository as RoleRepositoryContract;
use App\Contracts\Repositories\Admin\StatusRepository as AdminStatusRepositoryContract;
use App\Contracts\Repositories\Admin\TicketRepository as AdminTicketRepositoryContract;
use App\Contracts\Repositories\Admin\UserRepository as AdminUserRepositoryContract;
use App\Contracts\Repositories\BaseRepository as BaseRepositoryContract;
use App\Contracts\Repositories\StatusRepository as StatusRepositoryContract;
use App\Contracts\Repositories\TicketRepository as TicketRepositoryContract;
use App\Contracts\Repositories\UserRepository as UserRepositoryContract;
use App\Contracts\Services\Admin\CategoryService as CategoryServiceContract;
use App\Contracts\Services\Admin\RoleService as RoleServiceContract;
use App\Contracts\Services\Admin\StatusService as AdminStatusServiceContract;
use App\Contracts\Services\Admin\TicketService as AdminTicketServiceContract;
use App\Contracts\Services\Admin\UserService as AdminUserServiceContract;
use App\Contracts\Services\AuthService as AuthServiceContract;
use App\Contracts\Services\BaseService as BaseServiceContract;
use App\Contracts\Services\SessionService as SessionServiceContract;
use App\Contracts\Services\StatisticsService as StatisticsServiceContract;
use App\Contracts\Services\StatusService as StatusServiceContract;
use App\Contracts\Services\TicketService as TicketServiceContract;
use App\Contracts\Services\UserService as UserServiceContract;
use App\Mail\Mailer;
use App\Repositories\Admin\CategoryRepository;
use App\Repositories\Admin\RoleRepository;
use App\Repositories\Admin\StatusRepository as AdminStatusRepository;
use App\Repositories\Admin\TicketRepository as AdminTicketRepository;
use App\Repositories\Admin\UserRepository as AdminUserRepository;
use App\Repositories\BaseRepository;
use App\Repositories\StatusRepository;
use App\Repositories\TicketRepository;
use App\Repositories\UserRepository;
use App\Services\Admin\CategoryService;
use App\Services\Admin\RoleService;
use App\Services\Admin\StatusService as AdminStatusService;
use App\Services\Admin\TicketService as AdminTicketService;
use App\Services\Admin\UserService as AdminUserService;
use App\Services\AuthService;
use App\Services\BaseService;
use App\Services\SessionService;
use App\Services\StatisticsService;
use App\Services\StatusService;
use App\Services\TicketService;
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

        $this->app->bind(
            CategoryRepositoryContract::class,
            CategoryRepository::class
        );

        $this->app->bind(
            AdminStatusRepositoryContract::class,
            AdminStatusRepository::class
        );

        $this->app->bind(
            RoleRepositoryContract::class,
            RoleRepository::class
        );

        $this->app->bind(
            AdminUserRepositoryContract::class,
            AdminUserRepository::class
        );

        $this->app->bind(
            AdminTicketRepositoryContract::class,
            AdminTicketRepository::class
        );

        $this->app->bind(
            TicketRepositoryContract::class,
            TicketRepository::class
        );

        $this->app->bind(
            StatusRepositoryContract::class,
            StatusRepository::class
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
            AdminStatusServiceContract::class,
            AdminStatusService::class
        );

        $this->app->bind(
            RoleServiceContract::class,
            RoleService::class
        );

        $this->app->bind(
            AdminUserServiceContract::class,
            AdminUserService::class
        );

        $this->app->bind(
            AdminTicketServiceContract::class,
            AdminTicketService::class
        );

        $this->app->bind(
            TicketServiceContract::class,
            TicketService::class
        );

        $this->app->bind(
            StatusServiceContract::class,
            StatusService::class
        );

        $this->app->bind(
            UserServiceContract::class,
            UserService::class
        );

        $this->app->bind(
            StatisticsServiceContract::class,
            StatisticsService::class
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
