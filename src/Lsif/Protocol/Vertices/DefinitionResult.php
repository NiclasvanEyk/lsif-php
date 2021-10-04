<?php

namespace NiclasVanEyk\LsifPhp\Lsif\Protocol\Vertices;

class DefinitionResult extends Vertex
{
    public function toArray(): array
    {
        return $this->vertexToArray('definitionResult');
    }
}
