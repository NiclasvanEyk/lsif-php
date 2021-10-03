<?php

namespace NiclasVanEyk\LsifPhp\Lsif\Protocol\Edges;

class Contains extends MultiInEdge
{
    public function label(): string
    {
        return 'contains';
    }
}
