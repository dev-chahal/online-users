<?php

namespace DevChahal\OnlineUsers;

use Illuminate\Support\ServiceProvider;
use DevChahal\OnlineUsers\Console\InstallOnlineUsers;

class OnlineUsersServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/onlineusers.php', 'onlineusers');
    }

    public function boot()
    {
        
        if ($this->app->runningInConsole()) {
            /* Registering the Console Commands */
            $this->commands([
                InstallOnlineUsers::class,
            ]);

            /* Registering the Config File */
            $this->publishes([
                __DIR__.'/../config/onlineusers.php' => config_path('onlineusers.php'),
            ], 'config');

        }

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }
}