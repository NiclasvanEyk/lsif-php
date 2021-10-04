<?php

namespace NiclasVanEyk\LsifPhp\Lsif\Protocol\Edges\TextDocument;

use NiclasVanEyk\LsifPhp\Lsif\Protocol\Edges\Edge;

class Definition extends Edge
{
    public function label(): string
    {
        return 'textDocument/definition';
    }
}
