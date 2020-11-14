<?php

namespace Thoca\Rest\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

class MakeRestControllerCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:rest-controller';

    protected $hidden = true;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $type = 'Controller';

    protected function getStub()
    {
        return base_path('vendor/thoca/rest/src/stubs/Controller.php');
    }

    protected function getPath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);

        return base_path('app/Http/Controllers/' . $name . '.php');
    }

    protected function replaceClass($stub, $name)
    {
        $stub = parent::replaceClass($stub, $name);

        $modelName = Str::studly(str_replace('Controller', '', $this->argument('name')));

        return str_replace('DummyModel', $modelName, $stub);
    }
}
