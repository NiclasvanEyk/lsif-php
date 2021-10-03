<?php

namespace NiclasVanEyk\LsifPhp\Lang\Symbols;

use NiclasVanEyk\LsifPhp\Lang\Symbol;
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
