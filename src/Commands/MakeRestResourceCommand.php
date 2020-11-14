<?php

namespace Thoca\Rest\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

class MakeRestResourceCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:rest-resource';

    protected $hidden = true;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $type = 'Resource';

    protected function getStub()
    {
        return base_path('vendor/thoca/rest/src/stubs/Resource.php');
    }

    protected function getPath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);

        return base_path('app/Http/Resources/' . $name . '.php');
    }
}
