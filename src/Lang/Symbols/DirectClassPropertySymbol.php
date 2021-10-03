<?php

namespace NiclasVanEyk\LsifPhp\Lang\Symbols;

use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\Property;
use PhpParser\Node\Stmt\PropertyProperty;

class DirectClassPropertySymbol extends ClassPropertySymbol
{
    public function __construct(
        Class_ $class,
        private Property $propertyGroup,
        private PropertyProperty $property,
    ) {
        parent::__construct($class);
    }

    function fqn(): string
    {
        return $this->class->namespacedName->toString()
            . '#'
            . ($this->propertyGroup->isStatic() ? '$' : '')
            . $this->property->name;
    }
}
