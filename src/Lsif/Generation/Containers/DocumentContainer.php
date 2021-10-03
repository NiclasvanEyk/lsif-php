<?php

namespace NiclasVanEyk\LsifPhp\Lsif\Generation\Containers;

use NiclasVanEyk\LsifPhp\Lsif\Generation\LsifDumpContainer;
use NiclasVanEyk\LsifPhp\Lsif\Generation\LsifItemFactory;
use NiclasVanEyk\LsifPhp\Lsif\Protocol\Vertices\Document;
use PhpParser\Node;

class DocumentContainer
{
    private LsifItemFactory $factory;

    public function __construct(
        private LsifDumpContainer $dump,
        private ProjectContainer $project,
        private Document $document,
    ) {
        $this->factory = $this->dump->itemFactory;
    }

    public function addDefinition(Node $node): void
    {
        $range = $this->factory->range($node);
        $this->dump->addItem($range);

        $documentContains = $this->factory->contains($this->document, [$range]);
        $this->dump->addItem($documentContains);

        $resultSet = $this->factory->resultSet();
        $this->dump->addItem($resultSet);

        $next = $this->factory->next($range, $resultSet);
        $this->dump->addItem($next);

        $definitionResult = $this->factory->definitionResult();
        $this->dump->addItem($definitionResult);

        $textDocumentDefinition = $this->factory->definitionEdge(
            $resultSet,
            $definitionResult,
        );
        $this->dump->addItem($textDocumentDefinition);

        $item = $this->factory->item($definitionResult, [$range], $this->document);
        $this->dump->addItem($item);
    }
}
