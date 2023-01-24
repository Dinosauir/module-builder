<?php

declare(strict_types=1);


namespace Abacus\ModuleBuilder\Communication\Commands;

use Illuminate\Console\GeneratorCommand;

class DataCollectionMakeCommand extends GeneratorCommand
{
    protected $name = 'abacus:make:data-collection';

    protected $description = 'Create a new data collection class';

    protected $type = 'DataCollection';

    protected function getStub(): string
    {
        $basePath = "/stubs/business/data/";

        $class = 'datacollectionclass.stub';

        return $this->resolveStubPath($basePath . $class);
    }

    protected function resolveStubPath(string $stub): string
    {
        return file_exists($customPath = $this->laravel->basePath(trim($stub, '/')))
            ? $customPath
            : __DIR__ . $stub;
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace . '\Business\Shared\Data';
    }
}
