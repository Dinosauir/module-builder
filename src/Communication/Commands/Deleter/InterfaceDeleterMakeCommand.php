<?php

declare(strict_types=1);


namespace Abacus\ModuleBuilder\Communication\Commands\Deleter;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

class InterfaceDeleterMakeCommand extends GeneratorCommand
{
    protected $name = 'abacus:make-interfacedeleter';

    protected $description = 'Create a new interface deleter';

    protected $type = 'InterfaceDeleter';

    protected function getStub(): string
    {
        return $this->resolveStubPath('/stubs/interfacedeleter.stub');
    }

    protected function resolveStubPath(string $stub): string
    {
        return file_exists($customPath = $this->laravel->basePath(trim($stub, '/')))
            ? $customPath
            : __DIR__ . $stub;
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace . '\Persistence\Shared\Services\Deleter';
    }

    protected function getPath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);

        return $this->laravel['path'] . '/' . str_replace('\\', '/', $name) . 'DeleterInterface.php';
    }
}
