<?php

namespace NiclasVanEyk\LsifPhp\Lsif\Generation\Containers;

use NiclasVanEyk\LsifPhp\Lsif\Protocol\Vertices\DefinitionResult;
use NiclasVanEyk\LsifPhp\Lsif\Protocol\Vertices\HoverResult;
use NiclasVanEyk\LsifPhp\Lsif\Protocol\Vertices\Range;
use NiclasVanEyk\LsifPhp\Lsif\Protocol\Vertices\ReferenceResult;
use NiclasVanEyk\LsifPhp\Lsif\Protocol\Vertices\ResultSet;

class RangeContainer
{
    public function __construct(
        public Range $range,
        public ResultSet $resultSet,
        public ?DefinitionResult $definitionResult = null,
        public ?ReferenceResult $referenceResult = null,
        public ?HoverResult $hoverResult = null,
    ) { }
}
