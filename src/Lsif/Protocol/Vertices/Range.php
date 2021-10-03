<?php

namespace NiclasVanEyk\LsifPhp\Lsif\Protocol\Vertices;

use NiclasVanEyk\LsifPhp\Lsif\Protocol\Edges\Vertex;

class Range extends Vertex
{
    private int $startLine;
    private int $startCharacter;

    private int $endLine;
    private int $endCharacter;

    public function __construct(
        int $id,
        int $startLine,
        int $startCharacter,
        int $endLine,
        int $endCharacter
    ) {
        parent::__construct($id);

        $this->startLine = $startLine;
        $this->startCharacter = $startCharacter;
        $this->endLine = $endLine;
        $this->endCharacter = $endCharacter;
    }

    public function toArray(): array
    {
        return $this->vertexToArray('range', [
            'start' => [
                'line' => $this->startLine,
                'character' => $this->startCharacter,
            ],
            'end' => [
                'line' => $this->endLine,
                'character' => $this->endCharacter,
            ],
        ]);
    }
}
