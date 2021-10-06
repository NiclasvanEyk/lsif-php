<?php

namespace NiclasVanEyk\LsifPhp\Lsif\Protocol\Raw\Vertices;

class DefinitionResult extends Vertex
{
    public function toArray(): array
    {
        return $this->vertexToArray('definitionResult');
    }
}
