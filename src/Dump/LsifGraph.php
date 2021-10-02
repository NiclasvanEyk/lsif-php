<?php

namespace NiclasVanEyk\LsifPhp;

use NiclasVanEyk\LsifPhp\Implementations\Custom\IdGenerator;
use NiclasVanEyk\LsifPhp\Implementations\Custom\LsifGraphDocuments;
use NiclasVanEyk\LsifPhp\Implementations\Custom\LsifGraphHoverResults;

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

    public function nextId(): int
    {
        return $this->ids->next();
    }
}
