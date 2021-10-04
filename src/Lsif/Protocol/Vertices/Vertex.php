<?php

namespace NiclasVanEyk\LsifPhp\Lsif\Protocol\Vertices;

use NiclasVanEyk\LsifPhp\Lsif\Protocol\LsifGraphItem;

abstract class Vertex extends LsifGraphItem
{
    protected function vertexToArray(
        string $label,
        array $attributes = [],
    ): array {
        return array_merge([
            'id' => $this->id,
            'type' => 'vertex',
            'label' => $label,
        ], $attributes);
    }
}
