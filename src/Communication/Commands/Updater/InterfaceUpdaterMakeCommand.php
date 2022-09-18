<?php

declare(strict_types=1);


namespace Abacus\ModuleBuilder\Communication\Commands\Updater;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

class InterfaceUpdaterMakeCommand extends GeneratorCommand
{
    protected $name = 'abacus:make-interfaceupdater';

    protected $description = 'Create a new interface updater';

    protected $type = 'InterfaceUpdater';

    protected function getStub(): string
    {
        return $this->resolveStubPath('/stubs/interfaceupdater.stub');
    }

    protected function resolveStubPath(string $stub): string
    {
        return file_exists($customPath = $this->laravel->basePath(trim($stub, '/')))
            ? $customPath
            : __DIR__ . $stub;
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace . '\Persistence\Shared\Services\Updater';
    }

    protected function getPath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);

        return $this->laravel['path'] . '/' . str_replace('\\', '/', $name) . 'UpdaterInterface.php';
    }
}
