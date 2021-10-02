<?php

namespace NiclasVanEyk\LsifPhp\Implementations\Custom\NodeHandlers;

use NiclasVanEyk\LsifPhp\Implementations\Custom\NodeHandler;
use NiclasVanEyk\LsifPhp\Implementations\Custom\RangeFactory;
use NiclasVanEyk\LsifPhp\Protocol\Edges\Next;
use NiclasVanEyk\LsifPhp\Protocol\Vertices\ResultSet;
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
