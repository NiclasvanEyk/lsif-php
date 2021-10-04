<?php

namespace NiclasVanEyk\LsifPhp\Lsif\Protocol\Vertices;

class HoverResult extends Vertex
{

    public function __construct(
        int $id,
        private string $language,
        private string $value,
        private string $documentation = ''
    ) {
        parent::__construct($id);
    }

    public function toArray(): array
    {
        return $this->vertexToArray('hoverResult', [
            'language' => $this->language,
            'result' => [
                'contents' => [
                    ['language' => $this->language, 'value' => $this->value],
                    $this->documentation,
                ]
            ],
        ]);
    }
}
