<?php

declare(strict_types=1);


namespace Abacus\ModuleBuilder\Business\Services;

use Abacus\ModuleBuilder\Business\Contracts\ModuleInterface;
use Illuminate\Console\Command;

class BusinessService
{
    private const PROVIDER_SUFFIX = 'ServiceProvider';

    private const DATA_SUFFIX = 'Data';

    private const BUSINESS_PATH_ROOT = 'App\\Business\\%s\\';

    public function createData(Command $command, ModuleInterface $module): void
    {
        $command->call(
            'abacus:make-data',
            ['name' => $this->getBasePath($module) . self::DATA_SUFFIX . '\\' . $module->getName() . self::DATA_SUFFIX]
        );
    }

    public function createProvider(Command $command, ModuleInterface $module): void
    {
        $command->call(
            'abacus:make-provider',
            ['name' => $this->getBasePath($module) . $module->getName() . self::PROVIDER_SUFFIX]
        );
    }

    public function createCreator(Command $command, ModuleInterface $module): void
    {
        $creatorCommands = [
            'abacus:make-interfacecreator',
            'abacus:make-abstractcreator',
            'abacus:make-creator'
        ];

        foreach ($creatorCommands as $creatorCommand) {
            $command->call(
                $creatorCommand,
                ['name' => $this->getBasePath($module) . 'Services\\Creator\\' . $module->getName()]
            );
        }
    }

    public function createFacade(Command $command, ModuleInterface $module): void
    {
        $command->call(
            'abacus:make-facade',
            ['name' => $this->getBasePath($module) . 'Facade\\' . $module->getName()]
        );
    }

    private function getBasePath(ModuleInterface $module): string
    {
        return sprintf(self::BUSINESS_PATH_ROOT, $module->getName());
    }
}
