<?php

namespace NiclasVanEyk\LsifPhp;

use LanguageServer\Definition;
use NiclasVanEyk\LsifPhp\Dump\IdGenerator;
use NiclasVanEyk\LsifPhp\Dump\LsifGraphDocuments;
use NiclasVanEyk\LsifPhp\Dump\LsifGraphHoverResults;

class LsifGraph
{
    private IdGenerator $ids;
    private LsifGraphDocuments $documents;
    private LsifGraphHoverResults $hoverResults;

    public function __construct()
    {
        $this->ids = new IdGenerator();
        $this->documents = new LsifGraphDocuments($this->ids);
    }

    public function add(Definition $definition)
    {
        $this->documents->maybeAdd($definition);
        $definition->

//        if ($definition->symbolInformation)
    }
}