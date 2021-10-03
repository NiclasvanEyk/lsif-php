<?php

namespace NiclasVanEyk\LsifPhp\Lsif\Protocol\Edges;

use NiclasVanEyk\LsifPhp\Lsif\Protocol\LsifGraphItem;

abstract class MultiInEdge extends LsifGraphItem
{
    private Vertex $out;

    /** @var Vertex[] */
    private array $in;

    /**
     * @param int $id
     * @param Vertex $out
     * @param Vertex[] $in
     */
    public function __construct(int $id, Vertex $out, array $in) {
        parent::__construct($id);
        $this->out = $out;
        $this->in = $in;
    }

    abstract public function label(): string;

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'type' => 'vertex',
            'label' => $this->label(),
            'outV' =>$this->out->id,
            'inVs' => array_map(fn ($v) => $v->id, $this->in),
        ];
    }
}
