<?php

namespace NiclasVanEyk\LsifPhp\Implementations\Custom\Project\Symbols;

use NiclasVanEyk\LsifPhp\Implementations\Custom\Project\Symbol;
use PhpParser\Node\Stmt\Trait_;

class TraitSymbol extends Symbol
{
    public function __construct(private Trait_ $trait)
    {
    }

    function fqn(): string
    {
        return $this->trait->namespacedName;
    }
}
