<?php

namespace NiclasVanEyk\LsifPhp\Implementations\Custom;

use NiclasVanEyk\LsifPhp\Implementations\Custom\Project\File;
use NiclasVanEyk\LsifPhp\Implementations\Custom\SymbolCollection\DeclarationHandler;
use NiclasVanEyk\ScopeResolvingVisitor\Scope;
use NiclasVanEyk\ScopeResolvingVisitor\ScopeResolvingVisitor;
use PhpParser\Node;
use PhpParser\NodeVisitorAbstract;

class SymbolCollectingVisitor extends NodeVisitorAbstract
{
    public function __construct(
        private File $file,
        private ScopeResolvingVisitor $scopeVisitor,
        private DeclarationHandler $declarationHandler
    ) { }

    public function enterNode(Node $node)
    {
        if ($node instanceof Node\Name\FullyQualified) {
            $addReference = '';
        }

        if ($node instanceof Node\Stmt\Class_) {
            $this->declarationHandler->classDeclared($node);
        }

        else if ($node instanceof Node\Stmt\Interface_) {
            $this->declarationHandler->interfaceMethodDeclared($node);
        }

        else if ($node instanceof Node\Stmt\Trait_) {
            $this->declarationHandler->traitMethodDeclared($node);
        }

        else if ($node instanceof Node\Stmt\Property) {
            if (($class = $this->inferClassFromScope()) === null) return;
            foreach ($node->props as $property) {
                $this->declarationHandler->classPropertyDeclared(
                    $class,
                    $node,
                    $property,
                );
            }
        }

        else if ($node instanceof Node\Stmt\ClassMethod) {
            if (($class = $this->inferClassFromScope()) === null) return;

            if ((string) $node->name === '__construct') {
                foreach ($node->getParams() as $parameter) {
                    if ($parameter->flags !== 0) {
                        $this->declarationHandler->constructorPropertyPromoted(
                            $class,
                            $parameter,
                        );
                    }
                }
            }

            $this->declarationHandler->classMethodDeclared($class, $node);
        }

        else if ($node instanceof Node\VarLikeIdentifier) {
            $this->declarationHandler->variableDeclared($node);
        }
    }

    private function scope(): Scope
    {
        return $this->scopeVisitor->scope();
    }

    private function inferClassFromScope(): ?Node\Stmt\Class_
    {
        $scope = $this->scope();

        if ($scope instanceof Scope\ClassMethodScope) {
            return $scope->classLike;
        }

        if (!($scope instanceof Scope\ClassLikeScope)) return null;

        $class = $scope->classLike;

        if (!($class instanceof Node\Stmt\Class_)) return null;

        return $class;
    }
}
