<?php

namespace NiclasVanEyk\LsifPhp\Implementations\Custom\Project\Symbols;

use NiclasVanEyk\LsifPhp\Implementations\Custom\Project\Symbol;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\Property;
use PhpParser\Node\Stmt\PropertyProperty;

class ClassPropertySymbol extends Symbol
{
    public function __construct(
        private Class_ $class,
        private Property $p,
        private PropertyProperty $property,
    ) {
    }

    function fqn(): string
    {
        return $this->class->namespacedName->toString()
            . '#'
            . $this->p->isStatic() ? '$' : ''
            . $this->property->name->toString();
    }
}
