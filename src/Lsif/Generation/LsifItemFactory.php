<?php

namespace NiclasVanEyk\LsifPhp\Lsif\Generation;

use NiclasVanEyk\LsifPhp\Lsif\Protocol\Edges\Contains;
use NiclasVanEyk\LsifPhp\Lsif\Protocol\Edges\Item;
use NiclasVanEyk\LsifPhp\Lsif\Protocol\Edges\Next;
use NiclasVanEyk\LsifPhp\Lsif\Protocol\Edges\TextDocumentDefinition;
use NiclasVanEyk\LsifPhp\Lsif\Protocol\Edges\Vertex;
use NiclasVanEyk\LsifPhp\Lsif\Protocol\Vertices\DefinitionResult;
use NiclasVanEyk\LsifPhp\Lsif\Protocol\Vertices\Document;
use NiclasVanEyk\LsifPhp\Lsif\Protocol\Vertices\Range;
use NiclasVanEyk\LsifPhp\Lsif\Protocol\Vertices\ResultSet;
use PhpParser\Node;

class LsifItemFactory
{
    public function __construct(private LsifDumpContainer $dump) { }

    public function range(Node $node): Range
    {
        return new Range(
            $this->dump->nextId(),
            $node->getStartLine(),
            $node->getStartTokenPos(),
            $node->getEndLine(),
            $node->getEndTokenPos(),
        );
    }

    public function contains(Vertex $out, array $in): Contains
    {
        return new Contains($this->dump->nextId(), $out, $in);
    }

    public function resultSet(): ResultSet
    {
        return new ResultSet($this->dump->nextId());
    }

    public function next(Vertex $out, Vertex $in): Next
    {
        return new Next($this->dump->nextId(), $out, $in);
    }

    public function definitionResult(): DefinitionResult
    {
        return new DefinitionResult($this->dump->nextId());
    }

    public function definitionEdge(Vertex $out, Vertex $in): TextDocumentDefinition
    {
        return new TextDocumentDefinition($this->dump->nextId(), $out, $in);
    }

    public function item(Vertex $out, array $in, Document $document): Item
    {
        return new Item($this->dump->nextId(), $out, $in, $document);
    }
}
