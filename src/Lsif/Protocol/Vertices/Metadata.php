<?php

namespace NiclasVanEyk\LsifPhp\Lsif\Protocol\Vertices;

use NiclasVanEyk\LsifPhp\Lsif\Protocol\Edges\Vertex;

class Metadata extends Vertex
{
    public function __construct(
        public int $id,
        public string $version,
        public string $projectRoot,
        public array $toolInfo = [],
    ) {
        parent::__construct($id);
    }

    public function toArray(): array
    {
        return $this->vertexToArray('metaData', [
            'version' => $this->version,
            'projectRoot' => $this->projectRoot,
            'toolInfo' => $this->toolInfo,
        ]);
    }
}