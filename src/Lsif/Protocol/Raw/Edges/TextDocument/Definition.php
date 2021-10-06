<?php

namespace NiclasVanEyk\LsifPhp\Lsif\Protocol\Raw\Edges\TextDocument;

use NiclasVanEyk\LsifPhp\Lsif\Protocol\Raw\Edges\Edge;

class Definition extends Edge
{
    public function label(): string
    {
        return 'textDocument/definition';
    }
}
