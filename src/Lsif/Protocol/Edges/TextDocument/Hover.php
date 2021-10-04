<?php

namespace NiclasVanEyk\LsifPhp\Lsif\Protocol\Edges\TextDocument;

use NiclasVanEyk\LsifPhp\Lsif\Protocol\Edges\Edge;

class Hover extends Edge
{
    public function label(): string
    {
        return 'textDocument/hover';
    }
}
