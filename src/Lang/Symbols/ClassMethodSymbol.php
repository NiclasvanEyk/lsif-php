<?php

namespace NiclasVanEyk\LsifPhp\Lang\Symbols;

use NiclasVanEyk\LsifPhp\Lang\Symbol;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\ClassMethod;

class ClassMethodSymbol extends Symbol
{
    public function __construct(
        private Class_ $class,
        private ClassMethod $method,
    ) {
    }

    function fqn(): string
    {
        $accessor = $this->method->isStatic() ? '::' : '->';

        return $this->class->namespacedName->toString()
            . $accessor
            . $this->method->name->toString()
            . '()';
    }
}
