<?php

namespace NiclasVanEyk\LsifPhp\Lsif\Protocol\Vertices;

class Project extends Vertex
{
    public function __construct(int $id, private string $kind)
    {
        parent::__construct($id);
    }

    public function toArray(): array
    {
        return $this->vertexToArray('project', [
            'kind' => $this->kind,
        ]);
    }
}
