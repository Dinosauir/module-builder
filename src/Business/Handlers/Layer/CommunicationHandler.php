<?php

declare(strict_types=1);


namespace Abacus\ModuleBuilder\Business\Handlers\Layer;

use Abacus\ModuleBuilder\Business\Contracts\ModuleInterface;
use Abacus\ModuleBuilder\Business\Handlers\AbstractHandler;

class CommunicationHandler extends AbstractHandler
{
    protected function process(ModuleInterface $module): ModuleInterface
    {
        if (!$this->getSuccessor()) {
            $this->setSuccessor(new PersistenceHandler($this->command));
        }

        return $module;
    }
}
