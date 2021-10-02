<?php

namespace NiclasVanEyk\LsifPhp\Implementations\Custom;

use NiclasVanEyk\LsifPhp\Implementations\Custom\DocumentContainer;
use NiclasVanEyk\LsifPhp\Implementations\Custom\NodeHandlers\ClassNodeHandler;
use NiclasVanEyk\LsifPhp\Implementations\Custom\Project\ComposerProject;
use NiclasVanEyk\LsifPhp\Implementations\Custom\Project\File;
use NiclasVanEyk\LsifPhp\Implementations\Custom\Project\Symbols\ClassPropertySymbol;
use NiclasVanEyk\LsifPhp\Implementations\Custom\Project\Symbols\ClassSymbol;
use NiclasVanEyk\LsifPhp\LsifGraph;
use NiclasVanEyk\LsifPhp\Protocol\Edges\Next;
use NiclasVanEyk\LsifPhp\Protocol\Vertices\DefinitionResult;
use NiclasVanEyk\LsifPhp\Protocol\Vertices\Range;
use NiclasVanEyk\LsifPhp\Protocol\Vertices\ResultSet;
use NiclasVanEyk\ScopeResolvingVisitor\ScopeResolvingVisitor;
use PhpParser\Node;
use PhpParser\NodeVisitorAbstract;

class LsifGraphItemCollectingVisitor extends NodeVisitorAbstract
{
    /**
     * @var array<class-string<Node>, class-string<NodeHandler>>
     */
    private array $nodeTypeHandlerClasses = [
        Node\Stmt\Class_::class => ClassNodeHandler::class,
    ];

    /** @var array<class-string<Node>, NodeHandler> */
    private array $nodeTypeHandlers = [];

    public function __construct(
        private LsifGraph $graph,
        private File $file,
        private ComposerProject $project,
        private DocumentContainer $document,
        private ScopeResolvingVisitor $scopeVisitor,
    ) {
        foreach ($this->nodeTypeHandlerClasses as $nodeClass => $handlerClass) {
            $this->nodeTypeHandlers[$nodeClass] = new $handlerClass($this->graph);
        }
    }

    public function enterNode(Node $node)
    {
        if (array_key_exists($node::class, $this->nodeTypeHandlers)) {
            $this->nodeTypeHandlers[$node::class]->enterNode($node);
            return;
        }

        if ($node instanceof Node\Stmt\Class_) {
            $this->project->define(new ClassSymbol($node));
        } else if ($node instanceof Node\Stmt\Property) {
            $this->project->define(new ClassPropertySymbol($node));
        }

        if ($node instanceof Node\Stmt\ClassMethod) {
            $range = $this->rangeFor($node);
            $resultSet = new ResultSet($this->graph->nextId());
            $edge = new Next($this->graph->nextId(), $resultSet, $range);
        } else if ($node instanceof Node\Expr\PropertyFetch) {
            $definition = new DefinitionResult($this->graph->nextId());
        }
    }

    public function leaveNode(Node $node)
    {
        if ($node instanceof Node\Stmt\ClassLike) {
            $this->currentClassLike = null;
        }
    }
}
