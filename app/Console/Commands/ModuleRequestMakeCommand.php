<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use InvalidArgumentException;

class ModuleRequestMakeCommand extends GeneratorCommand
{
    const REQUEST_TYPE_FILTER = 'Filter';
    const REQUEST_TYPE_STORE = 'Store';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:module:request {name} {RequestType}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new request class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Request';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        if (!in_array($this->argument('RequestType'), [self::REQUEST_TYPE_FILTER, self::REQUEST_TYPE_STORE])) {
            throw new InvalidArgumentException('Request type does not exists.');
        }

        $requestType = $this->argument('RequestType');

        $stub = null;

        if ($requestType == self::REQUEST_TYPE_FILTER) {
            $stub =  __DIR__.'/stubs/request-filter.stub';
        }

        if ($requestType == self::REQUEST_TYPE_STORE) {
            $stub =  __DIR__.'/stubs/request-store.stub';
        }

        return  $stub;
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Http\Requests';
    }
}

