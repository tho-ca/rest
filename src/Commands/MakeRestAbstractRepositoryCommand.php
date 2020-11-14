<?php

namespace Thoca\Rest\Commands;

use Illuminate\Console\GeneratorCommand;

class MakeRestAbstractRepositoryCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:rest-abstract-repository';

    protected $hidden = true;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $type = 'Abstract Repository';

    protected function getStub()
    {
        return base_path('vendor/thoca/rest/src/stubs/AbstractRepository.php');
    }

    protected function getPath($name)
    {
        return base_path('app/Repositories/AbstractRepository.php');
    }

}
