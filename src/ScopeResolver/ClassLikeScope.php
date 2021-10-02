<?php

namespace NiclasVanEyk\LsifPhp\ScopeResolver;

use PhpParser\Node\Stmt\ClassLike;

class ClassLikeScope extends Scope
{
    public function __construct(public ClassLike $classLike) {
        $this->variables = ['this'];
    }
}
