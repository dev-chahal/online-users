<?php

namespace DevChahal\OnlineUsers;

use Illuminate\Support\ServiceProvider;
use DevChahal\OnlineUsers\Console\InstallOnlineUsers;

class OnlineUsersServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/onlineusers.php', 'onlineusers');
        //$this->mergeConfigFrom(__DIR__.'/../config/onlineusers.php', 'onlineusers');
    }

    public function boot()
    {
        /* Registering the Console Commands */
        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallOnlineUsers::class,
            ]);

            $this->publishes([
                __DIR__.'/../config/onlineusers.php' => config_path('onlineusers.php'),
            ], 'config');
        }
    }
}