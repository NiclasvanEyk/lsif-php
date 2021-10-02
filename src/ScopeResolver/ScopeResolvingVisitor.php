<?php

namespace NiclasVanEyk\LsifPhp\Implementations\Custom;

use NiclasVanEyk\LsifPhp\ScopeResolver\ClassLikeScope;
use NiclasVanEyk\LsifPhp\ScopeResolver\Scope;
use NiclasVanEyk\LsifPhp\ScopeResolver\ScopeStack;
use PhpParser\Node;
use PhpParser\NodeVisitorAbstract;

class ScopeResolvingVisitor extends NodeVisitorAbstract
{
    private ScopeStack $scopes;

    /**
     * @var array<int, class-string<Node>>
     */
    private array $scopedNodes = [
        Node\Stmt\ClassLike::class,
        Node\FunctionLike::class,
        Node\Stmt\If_::class,
        Node\Stmt\Else_::class,
        Node\Stmt\ElseIf_::class,
        Node\Stmt\TryCatch::class,
        Node\Stmt\While_::class,
        Node\Stmt\For_::class,
        Node\Stmt\Foreach_::class,
        Node\Stmt\Switch_::class,
        Node\Stmt\Case_::class,
        Node\Expr\Match_::class,
        Node\MatchArm::class,
    ];

    public function __construct() {
        $this->scopes = new ScopeStack();
    }

    public function scope(): Scope
    {
        return $this->scopes->current();
    }

    public function enterNode(Node $node)
    {
        if (!$this->introducesScope($node)) {
            return null;
        }

        if ($node instanceof Node\Stmt\ClassLike) {
            $this->scopes->push(new ClassLikeScope($node));
        }
    }

    public function leaveNode(Node $node)
    {
        if ($this->introducesScope($node)) {
            $this->scopes->pop();
        }
    }

    private function introducesScope(Node $node): bool
    {
        return in_array($node::class, $this->scopedNodes);
    }
}
