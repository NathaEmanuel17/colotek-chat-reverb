<?php

namespace App\Providers;

use App\Repositories\MessageRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\UserRepository;
use App\Services\MessageService;
use App\Services\UserService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(MessageService::class, function ($app) {
            return new MessageService($app->make(MessageRepository::class));
        });
        $this->app->singleton(UserService::class, function ($app) {
            return new UserService($app->make(UserRepository::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
