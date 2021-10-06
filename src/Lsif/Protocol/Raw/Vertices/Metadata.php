<?php

namespace NiclasVanEyk\LsifPhp\Lsif\Protocol\Raw\Vertices;

class Metadata extends Vertex
{
    /**
     * @param int $id
     * @param string $version
     * @param string $projectRoot
     * @param array<mixed> $toolInfo
     */
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
//            'projectRoot' => $this->projectRoot,
            'positionEncoding' => 'utf-16',
            'toolInfo' => $this->toolInfo,
        ]);
    }
}
