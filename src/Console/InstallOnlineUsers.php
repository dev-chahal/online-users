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
        $this->info('Installing Online Users...');

        $this->info('Publishing configuration...');

        if (! $this->configExists('onlineusers.php')) {
            $this->publishConfiguration();
            $this->info('Published configuration');
        } else {
            if ($this->shouldOverwriteConfig()) {
                $this->info('Overwriting configuration file...');
                $this->publishConfiguration($force = true);
            } else {
                $this->info('Existing configuration was not overwritten');
            }
        }


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



}