<?php

namespace NiclasVanEyk\LsifPhp\Lsif\Protocol\Raw\Vertices;

class Project extends Vertex
{
    public function __construct(int $id, private string $kind, private string $name)
    {
        parent::__construct($id);
    }

    public function toArray(): array
    {
        return $this->vertexToArray('project', [
            'kind' => $this->kind,
            'name' => $this->name,
        ]);
    }
}
