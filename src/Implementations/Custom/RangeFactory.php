<?php

namespace NiclasVanEyk\LsifPhp\Implementations\Custom;

use NiclasVanEyk\LsifPhp\Protocol\Vertices\Range;
use PhpParser\Node;

class RangeFactory
{
    public static function for(Node $node, int $id): Range
    {
        return new Range(
            $id,
            $node->getStartLine(),
            $node->getStartTokenPos(),
            $node->getEndLine(),
            $node->getEndTokenPos(),
        );
    }
}
