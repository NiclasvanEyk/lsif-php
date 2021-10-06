<?php

namespace NiclasVanEyk\LsifPhp\Lsif\Generation\Containers;

use NiclasVanEyk\LsifPhp\Lsif\Protocol\Raw\Vertices\DefinitionResult;
use NiclasVanEyk\LsifPhp\Lsif\Protocol\Raw\Vertices\HoverResult;
use NiclasVanEyk\LsifPhp\Lsif\Protocol\Raw\Vertices\Range;
use NiclasVanEyk\LsifPhp\Lsif\Protocol\Raw\Vertices\ReferenceResult;
use NiclasVanEyk\LsifPhp\Lsif\Protocol\Raw\Vertices\ResultSet;

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
