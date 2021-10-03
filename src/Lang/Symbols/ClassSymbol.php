<?php

namespace NiclasVanEyk\LsifPhp\Lang\Symbols;

use NiclasVanEyk\LsifPhp\Lang\Symbol;
use PhpParser\Node\Stmt\Class_;

class ClassSymbol extends Symbol
{
    public function __construct(private Class_ $class) { }

    function fqn(): string
    {
        // TODO handle nulls e.g. anonymous classes, or just ignore for now
        return $this->class->namespacedName;
    }
}
