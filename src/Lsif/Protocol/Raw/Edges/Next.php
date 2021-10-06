<?php

namespace NiclasVanEyk\LsifPhp\Lsif\Protocol\Raw\Edges;

class Next extends Edge
{
    public function label(): string
    {
        return 'next';
    }
}
