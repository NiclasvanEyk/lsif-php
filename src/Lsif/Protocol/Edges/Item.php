<?php

namespace NiclasVanEyk\LsifPhp\Lsif\Protocol\Edges;

use NiclasVanEyk\LsifPhp\Lsif\Protocol\Vertices\Document;
use NiclasVanEyk\LsifPhp\Lsif\Protocol\Vertices\Vertex;

class Item extends MultiInEdge
{
    public function __construct(int $id, Vertex $out, array $in, private Document $document)
    {
        parent::__construct($id, $out, $in);
    }

    public function label(): string
    {
        return 'item';
    }

    protected function additionalData(): array
    {
        return ['shard' => $this->document->id];
    }
}
