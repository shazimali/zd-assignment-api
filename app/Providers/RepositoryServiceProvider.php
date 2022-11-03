<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\API\AuthRepository;
use App\Interfaces\API\AuthInterface;
use App\Interfaces\API\TaskInterface;
use App\Interfaces\API\UserInterface;
use App\Repositories\API\TaskRepository;
use App\Repositories\API\UserRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AuthInterface::class, AuthRepository::class);
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(TaskInterface::class, TaskRepository::class);
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
