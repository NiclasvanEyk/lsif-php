<?php

namespace NiclasVanEyk\LsifPhp\Lsif\Generation\Containers;

use NiclasVanEyk\LsifPhp\Lsif\Protocol\Raw\Edges\Contains;
use NiclasVanEyk\LsifPhp\Lsif\Protocol\Raw\Vertices\Begin;
use NiclasVanEyk\LsifPhp\Lsif\Protocol\Raw\Vertices\Document;
use NiclasVanEyk\LsifPhp\Lsif\Protocol\Raw\Vertices\End;
use NiclasVanEyk\LsifPhp\Lsif\Protocol\Raw\Vertices\Project;

class ProjectContainer
{
    public function __construct(
        private LsifDumpContainer $dump,
        public Project $project,
    ) { }

    public function beginDocument(string $uri, string $languageId = 'php'): DocumentContainer
    {
        $document = new Document($this->dump->nextId(), $uri, $languageId);
        $container = new DocumentContainer($this->dump, $document);

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
}
