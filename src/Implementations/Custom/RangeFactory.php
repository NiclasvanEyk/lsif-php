<?php

namespace NiclasVanEyk\LsifPhp\Implementations\Custom;

use NiclasVanEyk\LsifPhp\Lsif\Generation\LsifDumpContainer;
use NiclasVanEyk\LsifPhp\Lsif\Protocol\Vertices\Range;
use PhpParser\Node;

class RangeFactory
{
    public function __construct(private LsifDumpContainer $dump) { }

    public function for(Node $node): Range
    {
        return new Range(
            $this->dump->nextId(),
            $node->getStartLine(),
            $node->getStartTokenPos(),
            $node->getEndLine(),
            $node->getEndTokenPos(),
        );
    }
}
