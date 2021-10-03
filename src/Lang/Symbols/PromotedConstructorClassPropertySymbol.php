<?php

namespace NiclasVanEyk\LsifPhp\Lang\Symbols;

use PhpParser\Node\Param;
use PhpParser\Node\Stmt\Class_;

class PromotedConstructorClassPropertySymbol extends ClassPropertySymbol
{
    public function __construct(
        Class_ $class,
        private Param $parameter,
    ) {
        parent::__construct($class);
    }

    function fqn(): string
    {
        return $this->class->namespacedName->toString()
            . '#'
            . $this->parameter->var->name;
    }
}
