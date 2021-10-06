<?php

namespace NiclasVanEyk\LsifPhp\Lsif\Protocol\Raw\Edges;

class Contains extends MultiInEdge
{
    public function label(): string
    {
        return 'contains';
    }
}
