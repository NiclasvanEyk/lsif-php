<?php

namespace NiclasVanEyk\LsifPhp\ScopeResolver;

class ScopeStack
{
    private Scope $scope;

    public function __construct() {
        $this->scope = new Scope();
    }

    public function current(): Scope
    {
        return $this->scope;
    }

    public function push(Scope $next): Scope
    {
        $this->scope->child = $next;
        $next->parent = $this->scope;
        $this->scope = $next;

        return $this->scope;
    }

    public function pop(): Scope
    {
        if ($this->scope->isRoot()) {
            return $this->scope;
        }

        $this->scope = $this->scope->parent;
    }
}
