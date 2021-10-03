<?php

namespace NiclasVanEyk\LsifPhp\Lsif\Protocol\Vertices;

use NiclasVanEyk\LsifPhp\Lsif\Protocol\Edges\Vertex;

class DefinitionResult extends Vertex
{
    public function toArray(): array
    {
        return $this->vertexToArray('definitionResult');
    }
}
