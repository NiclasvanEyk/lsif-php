<?php

namespace NiclasVanEyk\LsifPhp\Lsif\Protocol\Builder;

use NiclasVanEyk\LsifPhp\Lsif\Protocol\Raw\Edges\Item;
use NiclasVanEyk\LsifPhp\Lsif\Protocol\Raw\Edges\TextDocument\Definition;
use NiclasVanEyk\LsifPhp\Lsif\Protocol\Raw\Edges\TextDocument\Hover;
use NiclasVanEyk\LsifPhp\Lsif\Protocol\Raw\LsifGraphItem;
use NiclasVanEyk\LsifPhp\Lsif\Protocol\Raw\Vertices\DefinitionResult;
use NiclasVanEyk\LsifPhp\Lsif\Protocol\Raw\Vertices\Document;
use NiclasVanEyk\LsifPhp\Lsif\Protocol\Raw\Vertices\HoverResult;
use NiclasVanEyk\LsifPhp\Lsif\Protocol\Raw\Vertices\Range as LsifRange;
use NiclasVanEyk\LsifPhp\Lsif\Protocol\Raw\Vertices\ResultSet;

class SymbolDefinition
{
    private ResultSet $resultSet;

    /**
     * @param LsifRange $range The raw range that should be managed.
     * @param Document $document The document this symbol is defined in.
     * @param IdGenerator $ids A way to generate unique identifiers.
     * @param callable(LsifGraphItem $item): void $onNodeCreated A function to call, when a new item is generated. This is intended to be used to add it to some sort of LSIF dump.
     * @noinspection PhpMissingParamTypeInspection callable cannot be set as the parameter type here
     */
    private function __construct(
        private LsifRange $range,
        private Document $document,
        private IdGenerator $ids,
        private $onNodeCreated,
    ) {
        $this->resultSet = $this->createNode(new ResultSet($this->nextId()));
        $this->createDefinitionResult();
    }

    /**
     * @param LsifRange $range The raw range that should be managed.
     * @param Document $document The document this symbol is defined in.
     * @param IdGenerator $ids A way to generate unique identifiers.
     * @param callable(LsifGraphItem $item): void $onNodeCreated A function to call, when a new item is generated. This is intended to be used to add it to some sort of LSIF dump.
     * @return SymbolDefinition
     * @noinspection PhpMissingParamTypeInspection callable cannot be set as the parameter type here
     */
    public static function create(
        LsifRange $range,
        Document $document,
        IdGenerator $ids,
        $onNodeCreated,
    )
    {
        return new self($range, $document, $ids, $onNodeCreated);
    }

    /**
     * @template ItemType of LsifGraphItem
     * @param ItemType $item
     * @return ItemType
     */
    private function createNode(LsifGraphItem $item): LsifGraphItem
    {
        call_user_func($this->onNodeCreated, $item);

        return $item;
    }

    private function createDefinitionResult(): void
    {
        $definitionResult = $this->createNode(
            new DefinitionResult($this->nextId())
        );
        $this->createNode(
            new Definition(
                $this->nextId(),
                $this->resultSet,
                $definitionResult,
            ),
        );
        $this->createNode(
            new Item(
                $this->nextId(),
                $definitionResult,
                [$this->range],
                $this->document,
            ),
        );
    }

    private function nextId(): int
    {
        return $this->ids->nextId();
    }

    public function range(): LsifRange
    {
        return $this->range;
    }

    public function addHoverDefinition(string $preview, string $documentation): void
    {
        $hoverResult = $this->createNode(
            new HoverResult($this->nextId(), 'php', $preview, $documentation),
        );
        $this->createNode(
            new Hover($this->nextId(), $this->resultSet, $hoverResult),
        );
    }
}
