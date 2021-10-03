<?php

namespace NiclasVanEyk\LsifPhp\Implementations\Custom\SymbolCollection;

use PhpParser\Node\Stmt\Trait_;
use PhpParser\Node\Param;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\Node\Stmt\Interface_;
use PhpParser\Node\Stmt\Property;
use PhpParser\Node\Stmt\PropertyProperty;
use PhpParser\Node\VarLikeIdentifier;

interface DeclarationHandler
{
    public function classDeclared(Class_ $class);
    public function classPropertyDeclared(Class_ $class, Property $propertyGroup, PropertyProperty $property);
    public function constructorPropertyPromoted(Class_ $class, Param $parameter);
    public function classMethodDeclared(Class_ $class, ClassMethod $method);
    public function interfaceMethodDeclared(Interface_ $interface);
    public function traitMethodDeclared(Trait_ $trait);
    public function variableDeclared(VarLikeIdentifier $variable);
}
