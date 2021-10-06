<?php

namespace NiclasVanEyk\LsifPhp\Lsif\Protocol\Raw\Edges;

use NiclasVanEyk\LsifPhp\Lsif\Protocol\Raw\LsifGraphItem;
use NiclasVanEyk\LsifPhp\Lsif\Protocol\Raw\Vertices\Vertex;

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

    /**
     * @return array<mixed>
     */
    protected function additionalData(): array
    {
        return [];
    }

    /**
     * @return array<mixed>
     */
    public function toArray(): array
    {
        return array_merge([
            'id' => $this->id,
            'type' => 'edge',
            'label' => $this->label(),
            'outV' => $this->out->id,
            'inV' => $this->in->id,
        ], $this->additionalData());
    }
}
