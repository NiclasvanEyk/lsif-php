<?php

namespace NiclasVanEyk\LsifPhp\Protocol;

abstract class Edge extends LsifGraphItem
{
    private Vertex $in;
    private Vertex $out;

    public function __construct(int $id, Vertex $in, Vertex $out) {
        parent::__construct($id);
        $this->in = $in;
        $this->out = $out;
    }

    abstract public function label(): string;

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'type' => 'vertex',
            'label' => $this->label(),
            'inV' => $this->in->id,
            'outV' => $this->out->id,
        ];
    }
}