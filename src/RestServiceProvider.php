<?php

namespace Thoca\Rest;

use Illuminate\Support\ServiceProvider;
use Thoca\Rest\Commands\MakeRestCommand;
use Thoca\Rest\Commands\MakeRestControllerCommand;
use Thoca\Rest\Commands\MakeRestModelCommand;
use Thoca\Rest\Commands\MakeRestRepositoryCommand;
use Thoca\Rest\Commands\MakeRestRequestCommand;
use Thoca\Rest\Commands\MakeRestResourceCommand;
use Thoca\Rest\Console\InstallRestPackage;

class RestServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallRestPackage::class,
                MakeRestCommand::class,
                MakeRestModelCommand::class,
                MakeRestResourceCommand::class,
                MakeRestRepositoryCommand::class,
                MakeRestRequestCommand::class,
                MakeRestControllerCommand::class,
            ]);
        }
    }
}
