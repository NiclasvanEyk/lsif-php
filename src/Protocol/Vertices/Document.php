<?php

namespace NiclasVanEyk\LsifPhp\Protocol\Vertices;

use NiclasVanEyk\LsifPhp\Protocol\Vertex;

class Document extends Vertex
{
    private string $uri;
    private string $languageId;

    public function __construct(int $id, string $uri, string $languageId = 'php')
    {
        parent::__construct($id);

        $this->uri = $uri;
        $this->languageId = $languageId;
    }

    public function toArray(): array
    {
        return $this->vertexToArray('document', [
            'uri' => $this->uri,
            'languageId' => $this->languageId,
        ]);
    }
}