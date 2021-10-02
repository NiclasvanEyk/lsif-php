<?php

namespace NiclasVanEyk\LsifPhp\Dump;

use LanguageServer\Definition;
use NiclasVanEyk\LsifPhp\Protocol\Vertices\Document;

class LsifGraphHoverResults
{
    private IdGenerator $ids;

    /** @var array<string, DocumentContainer> */
    private array $hoverResults = [];

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
        $this->hoverResults[$uri] = $container;
    }

    public function get(string $uri): ?DocumentContainer
    {
        return $this->hoverResults[$uri];
    }

    private function has(Definition $definition): bool
    {
        return array_key_exists(
            $this->extractUri($definition),
            $this->hoverResults,
        );
    }

    private function extractUri(Definition $definition): string
    {
        return $definition->symbolInformation->location->uri;
    }
}