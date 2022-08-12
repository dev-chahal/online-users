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

        $this->info('Installed Online Users');
    }


}