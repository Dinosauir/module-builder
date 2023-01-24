<?php

declare(strict_types=1);


namespace Abacus\ModuleBuilder\Communication\Commands;

use Illuminate\Console\GeneratorCommand;

class DataMakeCommand extends GeneratorCommand
{
    protected $name = 'abacus:make:data';

    protected $description = 'Create a new data class';

    protected $type = 'Data';

    protected function getOptions()
    {
        return [
            ['--translated']
        ];
    }

    protected function getStub(): string
    {
        $basePath = "/stubs/business/data/";

        $class = $this->option('translated') ? 'translateddataclass.stub' : 'dataclass.stub';

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
