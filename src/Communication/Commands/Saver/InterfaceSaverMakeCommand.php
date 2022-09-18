<?php

declare(strict_types=1);


namespace Abacus\ModuleBuilder\Communication\Commands\Saver;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

class InterfaceSaverMakeCommand extends GeneratorCommand
{
    protected $name = 'abacus:make-interfacesaver';

    protected $description = 'Create a new interface saver';

    protected $type = 'InterfaceSaver';

    protected function getStub(): string
    {
        return $this->resolveStubPath('/stubs/interfacesaver.stub');
    }

    protected function resolveStubPath(string $stub): string
    {
        return file_exists($customPath = $this->laravel->basePath(trim($stub, '/')))
            ? $customPath
            : __DIR__ . $stub;
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace . '\Persistence\Shared\Services\Saver';
    }

    protected function getPath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);

        return $this->laravel['path'] . '/' . str_replace('\\', '/', $name) . 'SaverInterface.php';
    }
}
