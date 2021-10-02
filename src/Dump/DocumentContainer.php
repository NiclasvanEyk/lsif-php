<?php

namespace NiclasVanEyk\LsifPhp\Dump;

use NiclasVanEyk\LsifPhp\Protocol\Vertex;
use NiclasVanEyk\LsifPhp\Protocol\Vertices\Document;

class DocumentContainer
{
    private Document $document;

    /** @var array<int, Vertex> */
    private array $contains = [];

    public function __construct(Document $document)
    {
        $this->document = $document;
    }

    public function add(Vertex $other): void
    {
        $this->contains[$other->id] = $other;
    }

    public function items(): array
    {
        return [
            $this->document->toArray(),
//            $this->
        ];
    }
}