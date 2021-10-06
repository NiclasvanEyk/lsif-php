<?php

namespace NiclasVanEyk\LsifPhp\Lsif\Protocol\Raw\Vertices;

class ResultSet extends Vertex
{
    public function toArray(): array
    {
        return $this->vertexToArray('resultSet');
    }
}
