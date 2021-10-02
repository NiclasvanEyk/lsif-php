<?php

namespace NiclasVanEyk\LsifPhp\Protocol\Vertices;

use NiclasVanEyk\LsifPhp\Protocol\Vertex;

class DefinitionResult extends Vertex
{
    public function toArray(): array
    {
        return $this->vertexToArray('definitionResult');
    }
}