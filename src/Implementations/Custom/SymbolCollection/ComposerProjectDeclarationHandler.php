<?php

namespace NiclasVanEyk\LsifPhp\Implementations\Custom\SymbolCollection;

use NiclasVanEyk\LsifPhp\Implementations\Custom\Project\ComposerProject;
use NiclasVanEyk\LsifPhp\Lang\Symbols\ClassMethodSymbol;
use NiclasVanEyk\LsifPhp\Lang\Symbols\ClassSymbol;
use NiclasVanEyk\LsifPhp\Lang\Symbols\DirectClassPropertySymbol;
use NiclasVanEyk\LsifPhp\Lang\Symbols\InterfaceSymbol;
use NiclasVanEyk\LsifPhp\Lang\Symbols\PromotedConstructorClassPropertySymbol;
use NiclasVanEyk\LsifPhp\Lang\Symbols\TraitSymbol;
use NiclasVanEyk\LsifPhp\Lang\Symbols\VariableSymbol;
use PhpParser\Node\Param;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\Node\Stmt\Interface_;
use PhpParser\Node\Stmt\Property;
use PhpParser\Node\Stmt\PropertyProperty;
use PhpParser\Node\Stmt\Trait_;
use PhpParser\Node\VarLikeIdentifier;

class ComposerProjectDeclarationHandler implements DeclarationHandler
{
    public function __construct(private ComposerProject $project) { }

    public function classDeclared(Class_ $class)
    {
        $this->project->define(new ClassSymbol($class));
    }

    public function classPropertyDeclared(Class_ $class, Property $propertyGroup, PropertyProperty $property)
    {
        $this->project->define(new DirectClassPropertySymbol($class, $propertyGroup, $property));
    }

    public function constructorPropertyPromoted(Class_ $class, Param $parameter)
    {
        $this->project->define(new PromotedConstructorClassPropertySymbol($class, $parameter));
    }

    public function classMethodDeclared(Class_ $class, ClassMethod $method)
    {
        $this->project->define(new ClassMethodSymbol($class, $method));
    }

    public function interfaceMethodDeclared(Interface_ $interface)
    {
        $this->project->define(new InterfaceSymbol($interface));
    }

    public function traitMethodDeclared(Trait_ $trait)
    {
        $this->project->define(new TraitSymbol($trait));
    }

    public function variableDeclared(VarLikeIdentifier $variable)
    {
        // TODO: This will be implemented at a later stage
        $symbol = new VariableSymbol('$this->file->path', $variable);
//            $this->project->define($symbol);
    }
}
