<?php

namespace Thoca\Rest\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class MakeRestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:rest {model}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command will generate a full REST API CRUD';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $modelName = Str::studly($this->argument('model'));

        $this->call('make:rest-model', [
            'name' => $modelName,
        ]);
        $this->call('make:rest-resource', [
            'name' => $modelName . 'Resource',
        ]);
        $this->call('make:rest-abstract-repository', [
            'name' => $modelName . 'Repository',
        ]);
        $this->call('make:rest-repository', [
            'name' => $modelName . 'Repository',
        ]);
        $this->call('make:rest-request', [
            'name' => $modelName . 'Request',
        ]);
        $this->call('make:rest-controller', [
            'name' => $modelName . 'Controller',
        ]);
    }
}
