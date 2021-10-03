<?php

namespace NiclasVanEyk\LsifPhp\Implementations\Custom\Project;

use NiclasVanEyk\LsifPhp\Implementations\Custom\RangeFactory;
use NiclasVanEyk\LsifPhp\Lsif\Protocol\Vertices\Range;
use PhpParser\Node;

class File
{
    private RangeFactory $rangeFactory;

    public function __construct(public string $path)
    {
        $this->rangeFactory = new RangeFactory()
    }

    /** @var array<string, array<int, Range>> */
    public array $references = [];

    public function addReference(string $fqn, Node $node, int $id): void
    {
        $this->references[$fqn] = RangeFactory::for($node, $id);
    }

    public function contents()
    {
        return file_get_contents($this->path);
    }
}
