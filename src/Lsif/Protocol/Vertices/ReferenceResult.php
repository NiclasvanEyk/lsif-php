<?php

namespace NiclasVanEyk\LsifPhp\Lsif\Protocol\Vertices;

class ReferenceResult extends Vertex
{
    public function toArray(): array
    {
        return $this->vertexToArray('referenceResult');
    }
}
