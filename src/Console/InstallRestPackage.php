<?php

namespace Thoca\Rest\Console;

use Illuminate\Console\Command;

class InstallRestPackage extends Command
{
    protected $signature = 'rest:install';

    protected $description = 'Install the Thoca Rest Package';

    public function handle()
    {
        $this->info('Installing BlogPackage...');

        $this->info('Publishing configuration...');

        $this->call('vendor:publish', [
            '--provider' => "Thoca\Rest\RestServiceProvider",
            '--tag' => "config"
        ]);

        $this->info('Installed RestPackage');
    }
}
