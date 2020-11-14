<?php

namespace Thoca\Rest\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

class MakeRestRepositoryCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:rest-repository';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $type = 'Repository';

    protected function getStub()
    {
        return base_path('vendor/thoca/rest/stubs/Repository.php');
    }

    protected function getPath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);

        return base_path('app/Repositories/' . $name . '.php');
    }

    protected function replaceClass($stub, $name)
    {
        $stub = parent::replaceClass($stub, $name);

        $modelName = Str::studly(str_replace('Repository', '', $this->argument('name')));

        return str_replace('DummyModel', $modelName, $stub);
    }
}
