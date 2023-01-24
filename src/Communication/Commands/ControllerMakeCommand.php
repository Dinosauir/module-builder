<?php

namespace Abacus\ModuleBuilder\Communication\Commands;

use Illuminate\Console\GeneratorCommand;

class ControllerMakeCommand extends GeneratorCommand
{
    protected $name = 'abacus:make:controller';

    protected $description = 'Create a new controller class';

    protected $type = 'Controller';

    protected function getStub(): string
    {
        return $this->resolveStubPath('/stubs/communication/controllers/controllerclass.stub');
    }

    protected function resolveStubPath(string $stub): string
    {
        return file_exists($customPath = $this->laravel->basePath(trim($stub, '/')))
            ? $customPath
            : __DIR__ . $stub;
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace . '\Communication\Shared\Controller';
    }
}
