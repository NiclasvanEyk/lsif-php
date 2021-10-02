<?php

namespace NiclasVanEyk\LsifPhp\Protocol\Edges;

use NiclasVanEyk\LsifPhp\Protocol\Edge;

class Contains extends Edge
{
    public function label(): string
    {
        return 'contains';
    }
}