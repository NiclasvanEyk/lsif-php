<?php

namespace NiclasVanEyk\LsifPhp\Implementations\Custom\Project\Symbols;

use PhpParser\Node\Const_;
use PhpParser\Node\Stmt\Class_;

class ClassConstSymbol
{
    public function __construct(
        private Class_ $class,
        private Const_ $const,
    ) {
    }

    function fqn(): string
    {
        return $this->class->namespacedName->toString()
            . '::'
            . $this->const->name->toString();
    }
}
