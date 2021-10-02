<?php

namespace NiclasVanEyk\LsifPhp\Implementations\Custom;

use NiclasVanEyk\LsifPhp\Dump\DocumentContainer;
use NiclasVanEyk\LsifPhp\LsifGraph;
use NiclasVanEyk\LsifPhp\Protocol\Edges\Next;
use NiclasVanEyk\LsifPhp\Protocol\Vertices\DefinitionResult;
use NiclasVanEyk\LsifPhp\Protocol\Vertices\Range;
use NiclasVanEyk\LsifPhp\Protocol\Vertices\ResultSet;
use PhpParser\Node;
use PhpParser\NodeVisitorAbstract;

class LsifGraphItemCollectingVisitor extends NodeVisitorAbstract
{
    private LsifGraph $graph;
    private DocumentContainer $document;

    private ?Node\Stmt\ClassLike $currentClassLike = null;

    public function enterNode(Node $node)
    {
        if ($node instanceof Node\Stmt\ClassLike) {
            $this->currentClassLike = $node;
            $range = $this->rangeFor($node);
            $resultSet = new ResultSet(123); // TODO
            $edge = new Next(123, $resultSet, $range);
        } else if ($node instanceof Node\Stmt\ClassMethod) {
            $range = $this->rangeFor($node);
            $resultSet = new ResultSet(123); // TODO
            $edge = new Next(123, $resultSet, $range);
        } else if ($node instanceof Node\Expr\PropertyFetch) {
            $definition = new DefinitionResult(123); // TODO
        }
    }

    private function rangeFor(Node $node): Range
    {
        return new Range(
            123, // TODO
            $node->getStartLine(),
            $node->getStartTokenPos(),
            $node->getEndLine(),
            $node->getEndTokenPos(),
        );
    }

    public function leaveNode(Node $node)
    {
        if ($node instanceof Node\Stmt\ClassLike) {
            $this->currentClassLike = null;
        }
    }


}