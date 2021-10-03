<?php

namespace NiclasVanEyk\LsifPhp\Lsif\Protocol\Vertices;

use NiclasVanEyk\LsifPhp\Lsif\Protocol\Edges\Vertex;

class HoverResult extends Vertex
{
    private string $language;
    private string $value;

    public function __construct(int $id, string $language, string $value)
    {
        parent::__construct($id);

        $this->language = $language;
        $this->value = $value;
    }

    public function toArray(): array
    {
        return $this->vertexToArray('hoverResult', [
            'language' => $this->language,
            'value' => $this->value,
        ]);
    }
}
