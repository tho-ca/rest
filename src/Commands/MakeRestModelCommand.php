<?php

namespace Thoca\Rest\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

class MakeRestModelCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:rest-model';

    protected $hidden = true;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $type = 'Model';

    protected function getStub()
    {

        return base_path('vendor/thoca/rest/src/stubs/Model.php');
    }

    protected function getPath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);

        return base_path('app/Models/' . $name . '.php');
    }
}
