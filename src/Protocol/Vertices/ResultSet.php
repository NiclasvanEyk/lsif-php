<?php

namespace NiclasVanEyk\LsifPhp\Protocol\Vertices;

use NiclasVanEyk\LsifPhp\Protocol\Vertex;

class ResultSet extends Vertex
{
    public function toArray(): array
    {
        return $this->vertexToArray('resultSet');
    }
}