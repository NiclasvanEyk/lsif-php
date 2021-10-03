<?php

namespace NiclasVanEyk\LsifPhp\Lang\Symbols;

use NiclasVanEyk\LsifPhp\Lang\Symbol;
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
