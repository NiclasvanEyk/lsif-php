<?php

namespace NiclasVanEyk\LsifPhp\Lsif\Generation;

/**
 * Builds FQSENs.
 *
 * See https://github.com/phpDocumentor/TypeResolver#on-types-and-element-names.
 *
 * | Structure       | FQSEN Example                        |
 * |-----------------|--------------------------------------|
 * | Constant        | `\MyNamespace\MY_CONSTANT`           |
 * | Function        | `\MyNamespace\myFunction()`          |
 * | Class           | `\MyNamespace\MyClass`               |
 * | Interface       | `\MyNamespace\MyInterface`           |
 * | Trait           | `\MyNamespace\MyTrait`               |
 * | Class constant  | `\MyNamespace\MyClass::MY_CONSTANT`  |
 * | Property        | `\MyNamespace\MyClass::$myProperty`  |
 * | Method          | `\MyNamespace\MyClass::myMethod()`   |
 */
class FqsenBuilder
{
    public function constant(string $namespace, string $name): string
    {
        return $namespace . '\\' . $name;
    }

    public function function(string $namespace, string $name): string
    {
        return $namespace . '\\' . $name . '()';
    }

    public function classLike(string $fqn): string
    {
        return $fqn;
    }

    public function property(string $class, string $property): string
    {
        return $this->classLike($class) . '::$' . $property;
    }

    public function method(string $class, string $method): string
    {
        return $this->classLike($class) . '::' . $method . '()';
    }
}
