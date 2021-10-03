<?php

namespace NiclasVanEyk\LsifPhp\Lsif\Protocol\Edges;

use NiclasVanEyk\LsifPhp\Lsif\Protocol\Vertices\Document;

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
        return ['document' => $this->document->id];
    }
}
