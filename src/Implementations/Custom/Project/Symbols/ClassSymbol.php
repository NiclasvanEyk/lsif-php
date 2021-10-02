<?php

namespace NiclasVanEyk\LsifPhp\Implementations\Custom\Project\Symbols;

use NiclasVanEyk\LsifPhp\Implementations\Custom\Project\Symbol;
use PhpParser\Node\Stmt\Class_;

class ClassSymbol extends Symbol
{
    public function __construct(private Class_ $class)
    {
    }

    function fqn(): string
    {
        // TODO handle nulls e.g. anonymous classes, or just ignore for now
        return $this->class->namespacedName;
    }
}
