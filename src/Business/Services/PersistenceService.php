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
            'abacus:make-interfacesaver',
            'abacus:make-abstractsaver',
            'abacus:make-saver'
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
            'abacus:make-interfaceupdater',
            'abacus:make-abstractupdater',
            'abacus:make-updater'
        ];

        foreach ($creatorCommands as $creatorCommand) {
            $command->call(
                $creatorCommand,
                ['name' => $this->getBasePath($module) . 'Services\\Updater\\' . $module->getName()]
            );
        }
    }

    public function createDeleter(Command $command, ModuleInterface $module): void
    {
        $deleterCommands = [
            'abacus:make-interfacedeleter',
            'abacus:make-deleter'
        ];

        foreach ($deleterCommands as $deleterCommand) {
            $command->call(
                $deleterCommand,
                ['name' => $this->getBasePath($module) . 'Services\\Deleter\\' . $module->getName()]
            );
        }
    }

    private function getBasePath(ModuleInterface $module): string
    {
        return sprintf(self::PERSISTENCE_PATH_ROOT, $module->getName());
    }
}
