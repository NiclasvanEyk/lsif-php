<?php

namespace NiclasVanEyk\LsifPhp\Lsif\Protocol\Edges;

use NiclasVanEyk\LsifPhp\Lsif\Protocol\LsifGraphItem;
use NiclasVanEyk\LsifPhp\Lsif\Protocol\Vertices\Vertex;

abstract class MultiOutEdge extends LsifGraphItem
{
    /**
     * @var Vertex[]
     */
    private array $out;
    private Vertex $in;

    /**
     * @param int $id
     * @param Vertex[] $out
     * @param Vertex $in
     */
    public function __construct(int $id, array $out, Vertex $in) {
        parent::__construct($id);
        $this->out = $out;
        $this->in = $in;
    }

    abstract public function label(): string;

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'type' => 'edge',
            'label' => $this->label(),
            'outVs' => array_map(fn ($v) => $v->id, $this->out),
            'inV' => $this->in->id,
        ];
    }
}
