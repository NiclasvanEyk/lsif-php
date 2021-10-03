<?php

namespace NiclasVanEyk\LsifPhp\Lsif\Generation\Containers;

use NiclasVanEyk\LsifPhp\Lsif\Generation\LsifDumpContainer;
use NiclasVanEyk\LsifPhp\Lsif\Protocol\Edges\Contains;
use NiclasVanEyk\LsifPhp\Lsif\Protocol\Vertices\Begin;
use NiclasVanEyk\LsifPhp\Lsif\Protocol\Vertices\Document;
use NiclasVanEyk\LsifPhp\Lsif\Protocol\Vertices\End;
use NiclasVanEyk\LsifPhp\Lsif\Protocol\Vertices\Project;

class ProjectContainer
{
    /**
     * @var array<string, DocumentContainer>
     */
    private array $documents = [];

    public function __construct(
        private LsifDumpContainer $dump,
        private Project $project,
    ) { }

    public function beginDocument(string $uri, string $languageId = 'php'): DocumentContainer
    {
        $document = new Document($this->dump->nextId(), $uri, $languageId);
        $container = new DocumentContainer($this->dump, $this, $document);
        $this->documents[$uri] = $container;

        $this->dump->addItem($document);
        $this->dump->addItem(
            new Begin($this->dump->nextId(), 'document', $document->id),
        );
        $this->dump->addItem(
            new Contains($this->dump->nextId(), $this->project, [$document]),
        );

        return $container;
    }

    public function endDocument(Document $document): void
    {
        $this->dump->addItem(
            new End($this->dump->nextId(), 'document', $document->id),
        );
    }

    public function getDocumentByUri(string $uri): ?Document
    {
        return $this->documents[$uri];
    }
}
