<?php

declare(strict_types=1);


namespace Abacus\ModuleBuilder\Communication\Commands\Deleter;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

class DeleterMakeCommand extends GeneratorCommand
{
    protected $name = 'abacus:make:deleter';

    protected $description = 'Create a new deleter class';

    protected $type = 'Deleter';

    protected function getStub(): string
    {
        return $this->resolveStubPath('/stubs/deleterclass.stub');
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

        return $this->laravel['path'].'/'.str_replace('\\', '/', $name).'Deleter.php';
    }
}
