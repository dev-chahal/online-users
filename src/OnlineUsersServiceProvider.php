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
        if ($this->app->runningInConsole()) {
            /* Registering the Console Commands */
            $this->commands([
                InstallOnlineUsers::class,
            ]);

            /* Registering the Config File */
            $this->publishes([
                __DIR__.'/../config/onlineusers.php' => config_path('onlineusers.php'),
            ], 'config');

            /* Registering the Migrations */
            if (! class_exists('UpdateUserTable')) {
                $this->publishes([
                    __DIR__ . '/../database/migrations/add_last_seen_users.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_add_last_seen_users.php'),
                ], 'migrations');
            }
        }
    }
}