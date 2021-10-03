<?php

namespace NiclasVanEyk\LsifPhp\Implementations\Custom\SymbolCollection\NodeHandlers;

use NiclasVanEyk\LsifPhp\Implementations\Custom\SymbolCollection\NodeHandler;
use NiclasVanEyk\LsifPhp\Implementations\Custom\SymbolCollection\RangeFactory;
use NiclasVanEyk\LsifPhp\Lsif\Protocol\Edges\Next;
use NiclasVanEyk\LsifPhp\Lsif\Protocol\Vertices\ResultSet;
use PhpParser\Node;

class ClassNodeHandler extends NodeHandler
{
    /**
     * @param Node\Stmt\Class_ $node
     */
    public function enterNode(Node $node): void
    {
        $range = RangeFactory::for($node, $this->graph->nextId());
        $resultSet = new ResultSet($this->graph->nextId());
        $edge = new Next($this->graph->nextId(), $resultSet, $range);
    }
}
