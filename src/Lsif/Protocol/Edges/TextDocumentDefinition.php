<?php

namespace NiclasVanEyk\LsifPhp\Lsif\Protocol\Edges;

class TextDocumentDefinition extends Edge
{
    public function label(): string
    {
        return 'textDocument/definition';
    }
}
