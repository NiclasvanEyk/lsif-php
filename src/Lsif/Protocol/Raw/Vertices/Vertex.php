<?php

namespace NiclasVanEyk\LsifPhp\Lsif\Protocol\Raw\Vertices;

use NiclasVanEyk\LsifPhp\Lsif\Protocol\Raw\LsifGraphItem;

abstract class Vertex extends LsifGraphItem
{
    /**
     * @param string $label
     * @param array<mixed> $attributes
     * @return array<mixed>
     */
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
