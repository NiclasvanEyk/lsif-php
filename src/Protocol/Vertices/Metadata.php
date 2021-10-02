<?php

namespace NiclasVanEyk\LsifPhp\Protocol\Vertices;

use NiclasVanEyk\LsifPhp\Protocol\Vertex;

class Metadata extends Vertex
{
    public function __construct(
        int $id,
        string $version,
        string $projectRoot,
        array $toolInfo = [],
    ) {
        parent::__construct($id);
    }

    public function toArray(): array
    {
        // TODO: Implement toArray() method.
    }
}
