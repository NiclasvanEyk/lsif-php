<?php

namespace NiclasVanEyk\LsifPhp\Lsif\Protocol\Raw\Edges\TextDocument;

use NiclasVanEyk\LsifPhp\Lsif\Protocol\Raw\Edges\Edge;

class Hover extends Edge
{
    public function label(): string
    {
        return 'textDocument/hover';
    }
}
