<?php

namespace NiclasVanEyk\LsifPhp\Implementations\Custom\Project\Symbols;

use NiclasVanEyk\LsifPhp\Implementations\Custom\Project\Symbol;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\Interface_;

class InterfaceSymbol extends Symbol
{
    public function __construct(private Interface_ $interface)
    {
    }

    function fqn(): string
    {
        return $this->interface->namespacedName;
    }
}
