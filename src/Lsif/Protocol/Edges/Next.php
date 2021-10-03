<?php

namespace NiclasVanEyk\LsifPhp\Lsif\Protocol\Edges;

class Next extends Edge
{
    public function label(): string
    {
        return 'next';
    }
}
