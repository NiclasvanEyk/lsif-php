<?php

namespace NiclasVanEyk\LsifPhp\Protocol\Edges;

use NiclasVanEyk\LsifPhp\Protocol\Edge;

class Next extends Edge
{
    public function label(): string
    {
        return 'next';
    }
}