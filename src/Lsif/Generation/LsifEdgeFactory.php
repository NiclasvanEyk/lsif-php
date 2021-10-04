<?php

namespace NiclasVanEyk\LsifPhp\Lsif\Generation;

use NiclasVanEyk\LsifPhp\Lsif\Generation\Containers\LsifDumpContainer;
use NiclasVanEyk\LsifPhp\Lsif\Protocol\Edges\Contains;
use NiclasVanEyk\LsifPhp\Lsif\Protocol\Edges\Item;
use NiclasVanEyk\LsifPhp\Lsif\Protocol\Edges\Next;
use NiclasVanEyk\LsifPhp\Lsif\Protocol\Edges\TextDocument\Definition;
use NiclasVanEyk\LsifPhp\Lsif\Protocol\Edges\TextDocument\Hover;
use NiclasVanEyk\LsifPhp\Lsif\Protocol\Vertices\Document;
use NiclasVanEyk\LsifPhp\Lsif\Protocol\Vertices\HoverResult;
use NiclasVanEyk\LsifPhp\Lsif\Protocol\Vertices\ResultSet;
use NiclasVanEyk\LsifPhp\Lsif\Protocol\Vertices\Vertex;

class LsifEdgeFactory
{
    public function __construct(private LsifDumpContainer $dump) { }

    public function contains(Vertex $out, array $in): Contains
    {
        return new Contains($this->dump->nextId(), $out, $in);
    }

    public function next(Vertex $out, Vertex $in): Next
    {
        return new Next($this->dump->nextId(), $out, $in);
    }

    public function definition(Vertex $out, Vertex $in): Definition
    {
        return new Definition($this->dump->nextId(), $out, $in);
    }

    public function item(Vertex $out, array $in, Document $document): Item
    {
        return new Item($this->dump->nextId(), $out, $in, $document);
    }

    public function hoverResult(ResultSet $out, HoverResult $in): Hover
    {
        return new Hover($this->dump->nextId(), $out, $in);
    }
}
