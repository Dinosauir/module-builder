<?php

declare(strict_types=1);

namespace Abacus\ModuleBuilder\Business;

use Abacus\ModuleBuilder\Business\Concerns\Concerns\HasName;
use Abacus\ModuleBuilder\Business\Contracts\ModuleInterface;

class Module implements ModuleInterface
{
    use HasName;
}
