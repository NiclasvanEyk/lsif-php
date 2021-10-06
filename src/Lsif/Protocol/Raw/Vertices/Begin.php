<?php

namespace NiclasVanEyk\LsifPhp\Lsif\Protocol\Raw\Vertices;

class Begin extends Event
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
            kind: 'begin',
            scope: $this->scope,
            data: $this->data,
        );
    }
}
