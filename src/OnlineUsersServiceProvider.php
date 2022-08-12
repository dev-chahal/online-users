<?php

namespace DevChahal\OnlineUsers;

use Illuminate\Support\ServiceProvider;
use DevChahal\OnlineUsers\Console\InstallOnlineUsers;

class OnlineUsersServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        /* Registering the Console Commands */
        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallOnlineUsers::class,
            ]);
        }
    }
}