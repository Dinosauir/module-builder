<?php

declare(strict_types=1);


namespace Abacus\ModuleBuilder\Communication\Commands\Creator;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

class AbstractCreatorMakeCommand extends GeneratorCommand
{
    protected $name = 'make:abstractcreator';

    protected $description = 'Create a new abstract creator class';

    protected $type = 'AbstractCreator';

    protected function getStub(): string
    {
        return $this->resolveStubPath('/stubs/abstractcreatorclass.stub');
    }

    protected function resolveStubPath(string $stub): string
    {
        return file_exists($customPath = $this->laravel->basePath(trim($stub, '/')))
            ? $customPath
            : __DIR__ . $stub;
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace . '\Business\Shared\Services\Creator';
    }

    protected function getPath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);

        $name = explode('\\', $name);
        $name[array_key_last($name)] = 'Abstract' . $name[array_key_last($name)];
        $name = implode('\\', $name);

        return $this->laravel['path'] . '/' . str_replace('\\', '/', $name) . 'Creator.php';
    }
}
