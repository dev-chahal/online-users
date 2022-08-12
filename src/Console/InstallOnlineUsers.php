<?php

namespace DevChahal\OnlineUsers\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallOnlineUsers extends Command
{
    protected $signature = 'onlineusers:install';

    protected $description = 'Install the Online Users';

    public function handle()
    {
        $this->comment('Installing Online Users...');

        $this->comment('Publishing configuration...');

        if (! $this->configExists('onlineusers.php')) {
            $this->publishConfiguration();
            $this->info('Published configuration');
        } else {
            if ($this->shouldOverwriteConfig()) {
                $this->comment('Overwriting configuration file...');
                $this->publishConfiguration($force = true);
            } else {
                $this->info('Existing configuration was not overwritten');
            }
        }

        // $this->comment('Publishing Migrations...');
        // $this->publishMigrations($force = true);
        // $this->info('Published Migrations');


        $this->info('Installed Online Users');
    }

    private function configExists($fileName)
    {
        return File::exists(config_path($fileName));
    }

    private function shouldOverwriteConfig()
    {
        return $this->confirm(
            'Config file already exists. Do you want to overwrite it?',
            false
        );
    }

    private function publishConfiguration($forcePublish = false)
    {
        $params = [
            '--provider' => "DevChahal\OnlineUsers\OnlineUsersServiceProvider",
            '--tag' => "config"
        ];

        if ($forcePublish === true) {
            $params['--force'] = true;
        }

       $this->call('vendor:publish', $params);
    }

    private function publishMigrations($forcePublish = false){
        $params = [
            '--provider' => "DevChahal\OnlineUsers\OnlineUsersServiceProvider",
            '--tag' => "migrations"
        ];

        if ($forcePublish === true) {
            $params['--force'] = true;
        }

       $this->call('vendor:publish', $params);
    }



}