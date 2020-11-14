<?php

namespace Thoca\Rest;

use Illuminate\Support\ServiceProvider;
use Thoca\Rest\Commands\MakeRestCommand;
use Thoca\Rest\Commands\MakeRestControllerCommand;
use Thoca\Rest\Commands\MakeRestModelCommand;
use Thoca\Rest\Commands\MakeRestRepositoryCommand;
use Thoca\Rest\Commands\MakeRestRequestCommand;
use Thoca\Rest\Commands\MakeRestResourceCommand;

class RestServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->commands([
            MakeRestCommand::class,
            MakeRestModelCommand::class,
            MakeRestResourceCommand::class,
            MakeRestRepositoryCommand::class,
            MakeRestRequestCommand::class,
            MakeRestControllerCommand::class,
        ]);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
