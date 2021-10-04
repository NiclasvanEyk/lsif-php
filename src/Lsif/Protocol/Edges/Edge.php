<?php

namespace NiclasVanEyk\LsifPhp\Lsif\Protocol\Edges;

use NiclasVanEyk\LsifPhp\Lsif\Protocol\LsifGraphItem;
use NiclasVanEyk\LsifPhp\Lsif\Protocol\Vertices\Vertex;

abstract class Edge extends LsifGraphItem
{
    private Vertex $out;
    private Vertex $in;

    public function __construct(int $id, Vertex $out, Vertex $in) {
        parent::__construct($id);
        $this->out = $out;
        $this->in = $in;
    }

    abstract public function label(): string;

    protected function additionalData(): array
    {
        return [];
    }

    public function toArray(): array
    {
        return array_merge([
            'id' => $this->id,
            'type' => 'vertex',
            'label' => $this->label(),
            'outV' => $this->out->id,
            'inV' => $this->in->id,
        ], $this->additionalData());
    }
}
