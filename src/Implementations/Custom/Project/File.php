<?php

namespace NiclasVanEyk\LsifPhp\Implementations\Custom\Project;

use NiclasVanEyk\LsifPhp\Implementations\Custom\RangeFactory;
use NiclasVanEyk\LsifPhp\Protocol\Vertices\Range;
use PhpParser\Node;

class File
{
    /** @var array<string, array<int, Range>> */
    public array $references = [];

    public function addReference(string $fqn, Node $node, int $id): void
    {
        $this->references[$fqn] = RangeFactory::for($node, $id);
    }
}
