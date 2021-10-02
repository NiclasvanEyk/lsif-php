<?php

namespace NiclasVanEyk\LsifPhp\Implementations\Custom;

use NiclasVanEyk\LsifPhp\LsifGraph;
use PhpParser\Node;

/**
 * @template NodeType of \PhpParser\Node
 */
abstract class NodeHandler
{
    public function __construct(protected LsifGraph $graph)
    {
    }

    abstract public function enterNode(Node $node): void;
}
