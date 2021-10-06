<?php

namespace NiclasVanEyk\LsifPhp\Lsif\Generation\Containers;

use NiclasVanEyk\LsifPhp\Lsif\Generation\LsifEdgeFactory;
use NiclasVanEyk\LsifPhp\Lsif\Generation\LsifVertexFactory;
use NiclasVanEyk\LsifPhp\Lsif\Protocol\Builder\SymbolDefinition;
use NiclasVanEyk\LsifPhp\Lsif\Protocol\Raw\Edges\Contains;
use NiclasVanEyk\LsifPhp\Lsif\Protocol\Raw\LsifGraphItem;
use NiclasVanEyk\LsifPhp\Lsif\Protocol\Raw\Vertices\Document;
use NiclasVanEyk\LsifPhp\Lsif\Protocol\Raw\Vertices\Range;
use NiclasVanEyk\LsifPhp\Lsif\Protocol\Raw\Vertices\ResultSet;
use PhpParser\Node;

class DocumentContainer
{
    private LsifEdgeFactory $edge;
    private LsifVertexFactory $vertex;

    public function __construct(
        private LsifDumpContainer $dump,
        public Document $document,
    ) {
        $this->edge = new LsifEdgeFactory($this->dump);
        $this->vertex = new LsifVertexFactory($this->dump);
    }

    public function defineSymbol(Node $nameNode, Node $docNode): void
    {
        $this->dump->addItem($range = $this->vertex->range($nameNode));
        $this->dump->addItem(new Contains($this->dump->nextId(), $this->document, [$range]));
        $symbol = SymbolDefinition::create(
            $range,
            $this->document,
            $this->dump,
            fn (LsifGraphItem $item) => $this->dump->addItem($item),
        );
        if (($comment = $docNode->getDocComment()) !== null) {
            $symbol->addHoverDefinition(
                'todo: add meaningful preview',
                $comment->getText(),
            );
        }
    }

    public function addDefinition(Node $nameNode, Node $docNode): void
    {
        $range = $this->addRange($nameNode);
        $resultSet = $this->addResultSet($range);
        $this->addDefinitionResult($range, $resultSet);
        $this->addHoverResult($docNode, $resultSet);
    }

    private function addRange(Node $node): Range
    {
        $range = $this->vertex->range($node);
        $this->dump->addItem($range);
        $this->dump->addItem($this->edge->contains($this->document, [$range]));

        return $range;
    }

    private function addResultSet(Range $range): ResultSet
    {
        $resultSet = $this->vertex->resultSet();
        $this->dump->addItem($resultSet);
        $this->dump->addItem($this->edge->next($range, $resultSet));

        return $resultSet;
    }

    public function addReference(Node $node): void
    {
        $range = $this->vertex->range($node);
        $this->dump->addItem($range);
    }

    private function addDefinitionResult(
        Range $range,
        ResultSet $resultSet,
    ): void {
        $definitionResult = $this->vertex->definitionResult();
        $this->dump->addItem($definitionResult);
        $this->dump->addItem($this->edge->definition(
            $resultSet,
            $definitionResult,
        ));
        $this->dump->addItem(
            $this->edge->item($definitionResult, [$range], $this->document)
        );
    }

    private function addHoverResult(Node $node, ResultSet $resultSet): void
    {
        if (($comment = $node->getDocComment()) !== null) {
            $hoverResult = $this->vertex->hoverResult(
                'php',
                'placeholder',
                $comment->getText(),
            );
            $this->dump->addItem($hoverResult);
            $this->dump->addItem(
                $this->edge->hoverResult($resultSet, $hoverResult)
            );
        }
    }
}
