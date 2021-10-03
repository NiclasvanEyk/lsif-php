<?php

namespace NiclasVanEyk\LsifPhp\Lsif\Protocol\Vertices;

use NiclasVanEyk\LsifPhp\Lsif\Protocol\Edges\Vertex;

abstract class Event extends Vertex
{
    protected function eventToArray(string $kind, string $scope, int $data): array
    {
        return $this->vertexToArray('$event', [
            'kind' => $kind,
            'scope' => $scope,
            'data' => $data,
        ]);
    }
}
