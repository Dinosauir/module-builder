<?php

declare(strict_types=1);


namespace Abacus\ModuleBuilder\Communication\Commands\Saver;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

class AbstractSaverMakeCommand extends GeneratorCommand
{
    protected $name = 'abacus:make:abstract:saver';

    protected $description = 'Create a new abstract saver class';

    protected $type = 'AbstractSaver';

    protected function getOptions()
    {
        return [
            ['--translated']
        ];
    }

    protected function getStub(): string
    {
        return $this->resolveStubPath(
            $this->option(
                'translated'
            ) ? 'translatedabstractsaverclass.stub' : 'abstractsaverclass.stub'
        );
    }

    protected function resolveStubPath(string $stub): string
    {
        return file_exists($customPath = $this->laravel->basePath(trim($stub, '/')))
            ? $customPath
            : __DIR__ .'/stubs/'. $stub;
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace . '\Persistence\Shared\Services\Saver';
    }

    protected function getPath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);

        $name = explode('\\', $name);
        $name[array_key_last($name)] = 'Abstract' . $name[array_key_last($name)];
        $name = implode('\\', $name);

        return $this->laravel['path'] . '/' . str_replace('\\', '/', $name) . 'Saver.php';
    }
}
