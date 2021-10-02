<?php

namespace NiclasVanEyk\LsifPhp\ScopeResolver;

class Scope
{
    public ?Scope $parent;
    public ?Scope $child;
    public array $variables = [];

    public function isRoot(): bool
    {
        return $this->parent === null;
    }

    public function isCurrent(): bool
    {
        return $this->child === null;
    }

    public function root(): Scope
    {
        $current = $this;

        while ($current->parent !== null) {
            $current = $current->parent;
        }

        return $current;
    }

    public function current(): Scope
    {
        $current = $this;

        while ($current->child !== null) {
            $current = $current->child;
        }

        return $current;
    }
}
