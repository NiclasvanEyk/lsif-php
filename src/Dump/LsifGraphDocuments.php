<?php

namespace NiclasVanEyk\LsifPhp\Dump;

use LanguageServer\Definition;
use NiclasVanEyk\LsifPhp\Protocol\Vertices\Document;

class LsifGraphDocuments
{
    private IdGenerator $ids;

    /** @var array<string, DocumentContainer> */
    private array $documents = [];

    public function __construct(IdGenerator $ids)
    {
        $this->ids = $ids;
    }

    public function maybeAdd(Definition $definition): void
    {
        if ($this->has($definition)) {
            return;
        }

        $uri = $this->extractUri($definition);
        $document = (new Document($this->ids->next(), $uri));
        $container = new DocumentContainer($document);
        $this->documents[$uri] = $container;
    }

    public function get(string $uri): ?DocumentContainer
    {
        return $this->documents[$uri];
    }

    private function has(Definition $definition): bool
    {
        return array_key_exists(
            $this->extractUri($definition),
            $this->documents,
        );
    }

    private function extractUri(Definition $definition): string
    {
        return $definition->symbolInformation->location->uri;
    }
}