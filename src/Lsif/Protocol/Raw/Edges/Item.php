<?php

namespace NiclasVanEyk\LsifPhp\Lsif\Protocol\Raw\Edges;

use NiclasVanEyk\LsifPhp\Lsif\Protocol\Raw\Vertices\Document;
use NiclasVanEyk\LsifPhp\Lsif\Protocol\Raw\Vertices\Vertex;

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

    /**
     * @return array<mixed>
     */
    protected function additionalData(): array
    {
        return ['shard' => $this->document->id];
    }
}
