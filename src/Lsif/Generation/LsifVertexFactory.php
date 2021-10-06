<?php

namespace NiclasVanEyk\LsifPhp\Lsif\Generation;

use NiclasVanEyk\LsifPhp\Lsif\Generation\Containers\LsifDumpContainer;
use NiclasVanEyk\LsifPhp\Lsif\Protocol\Raw\Vertices\DefinitionResult;
use NiclasVanEyk\LsifPhp\Lsif\Protocol\Raw\Vertices\HoverResult;
use NiclasVanEyk\LsifPhp\Lsif\Protocol\Raw\Vertices\Range;
use NiclasVanEyk\LsifPhp\Lsif\Protocol\Raw\Vertices\ResultSet;
use PhpParser\Node;

class LsifVertexFactory
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

    public function resultSet(): ResultSet
    {
        return new ResultSet($this->dump->nextId());
    }

    public function definitionResult(): DefinitionResult
    {
        return new DefinitionResult($this->dump->nextId());
    }

    public function hoverResult(
        string $language,
        string $value,
        string $documentation,
    ): HoverResult {
        return new HoverResult(
            $this->dump->nextId(),
            $language,
            $value,
            $documentation,
        );
    }
}
