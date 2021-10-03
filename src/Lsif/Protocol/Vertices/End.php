<?php

namespace NiclasVanEyk\LsifPhp\Lsif\Protocol\Vertices;

class End extends Event
{
    public function __construct(
        int $id,
        private string $scope,
        private int $data,
    ) {
        parent::__construct($id);
    }

    public function toArray(): array
    {
        return $this->eventToArray(
            kind: 'end',
            scope: $this->scope,
            data: $this->data,
        );
    }
}
