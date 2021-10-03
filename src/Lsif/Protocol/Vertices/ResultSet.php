<?php

namespace NiclasVanEyk\LsifPhp\Lsif\Protocol\Vertices;

use NiclasVanEyk\LsifPhp\Lsif\Protocol\Edges\Vertex;

class ResultSet extends Vertex
{
    public function toArray(): array
    {
        return $this->vertexToArray('resultSet');
    }
}
