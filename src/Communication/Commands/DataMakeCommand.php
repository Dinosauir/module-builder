<?php

declare(strict_types=1);


namespace Abacus\ModuleBuilder\Communication\Commands;

use Illuminate\Console\GeneratorCommand;

class DataMakeCommand extends GeneratorCommand
{
    protected $name = 'abacus:make-data';

    protected $description = 'Create a new data class';

    protected $type = 'Data';

    protected function getStub(): string
    {
        return $this->resolveStubPath('/stubs/business/data/dataclass.stub');
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
