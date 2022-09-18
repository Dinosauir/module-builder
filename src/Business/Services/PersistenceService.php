<?php

declare(strict_types=1);


namespace Abacus\ModuleBuilder\Business\Services;

use Abacus\ModuleBuilder\Business\Contracts\ModuleInterface;
use Illuminate\Console\Command;

class PersistenceService
{
    private const PERSISTENCE_PATH_ROOT = 'App\\Persistence\\%s\\';

    public function createModel(Command $command, ModuleInterface $module): void
    {
        $command->call(
            'make:model',
            ['name' => $this->getBasePath($module) . $module->getName()]
        );
    }

    public function createSaver(Command $command, ModuleInterface $module): void
    {
        $creatorCommands = [
            'make:interfacesaver',
            'make:abstractsaver',
            'make:saver'
        ];

        foreach ($creatorCommands as $creatorCommand) {
            $command->call(
                $creatorCommand,
                ['name' => $this->getBasePath($module) . 'Services\\Saver\\' . $module->getName()]
            );
        }
    }

    public function createUpdater(Command $command, ModuleInterface $module): void
    {
        $creatorCommands = [
            'make:interfaceupdater',
            'make:abstractupdater',
            'make:updater'
        ];

        foreach ($creatorCommands as $creatorCommand) {
            $command->call(
                $creatorCommand,
                ['name' => $this->getBasePath($module) . 'Services\\Updater\\' . $module->getName()]
            );
        }
    }

    private function getBasePath(ModuleInterface $module): string
    {
        return sprintf(self::PERSISTENCE_PATH_ROOT, $module->getName());
    }
}
