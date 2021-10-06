<?php

namespace NiclasVanEyk\LsifPhp\Lsif\Protocol\Raw\Vertices;

abstract class Event extends Vertex
{
    /**
     * @param string $kind
     * @param string $scope
     * @param int $data
     * @return array<mixed>
     */
    protected function eventToArray(string $kind, string $scope, int $data): array
    {
        return $this->vertexToArray('$event', [
            'kind' => $kind,
            'scope' => $scope,
            'data' => $data,
        ]);
    }
}
