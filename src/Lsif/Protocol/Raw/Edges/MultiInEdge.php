<?php

namespace NiclasVanEyk\LsifPhp\Lsif\Protocol\Raw\Edges;

use NiclasVanEyk\LsifPhp\Lsif\Protocol\Raw\LsifGraphItem;
use NiclasVanEyk\LsifPhp\Lsif\Protocol\Raw\Vertices\Vertex;

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
            'outV' =>$this->out->id,
            'inVs' => array_map(fn ($v) => $v->id, $this->in),
        ], $this->additionalData());
    }
}
