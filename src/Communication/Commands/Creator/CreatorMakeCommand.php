<?php

declare(strict_types=1);


namespace Abacus\ModuleBuilder\Communication\Commands\Creator;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

class CreatorMakeCommand extends GeneratorCommand
{
    protected $name = 'abacus:make:creator {--translated}';

    protected $description = 'Create a new creator class';

    protected $type = 'Creator';

    protected function getStub(): string
    {
        return $this->resolveStubPath(
            '/stubs/' . $this->option('translated') ? 'translatedcreatorclass.stub' : 'creatorclass.stub'
        );
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

        return $this->laravel['path'] . '/' . str_replace('\\', '/', $name) . 'Creator.php';
    }
}
