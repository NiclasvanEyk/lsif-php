<?php

namespace NiclasVanEyk\LsifPhp\Lsif\Protocol\Vertices;

class ResultSet extends Vertex
{
    public function toArray(): array
    {
        return $this->vertexToArray('resultSet');
    }
}
