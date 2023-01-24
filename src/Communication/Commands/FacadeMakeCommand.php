<?php

declare(strict_types=1);


namespace Abacus\ModuleBuilder\Communication\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

class FacadeMakeCommand extends GeneratorCommand
{
    protected $name = 'abacus:make:facade {--translated}';

    protected $description = 'Create a new facade';

    protected $type = 'Facade';

    protected function getStub(): string
    {
        $basePath = "/stubs/business/facades/";

        $class = $this->option('translated') ? 'translatedfacadeclass.stub' : 'facadeclass.stub';

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
        return $rootNamespace . '\Business\Shared\Facades';
    }

    protected function getPath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);

        return $this->laravel['path'] . '/' . str_replace('\\', '/', $name) . 'Facade.php';
    }
}
