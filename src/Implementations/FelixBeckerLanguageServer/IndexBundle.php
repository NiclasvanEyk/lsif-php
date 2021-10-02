<?php

namespace NiclasVanEyk\LsifPhp\Implementations\FelixBeckerLanguageServer;

use LanguageServer\Index\DependenciesIndex;
use LanguageServer\Index\GlobalIndex;
use LanguageServer\Index\Index;
use LanguageServer\Index\ProjectIndex;
use LanguageServer\Index\StubsIndex;
use stdClass;

class IndexBundle
{
    public Index $source;
    public DependenciesIndex $dependencies;
    public StubsIndex $stubs;
    public ProjectIndex $project;
    public GlobalIndex $global;

    public function __construct(?stdClass $composerJson = null)
    {
        $this->source = new Index();
        $this->dependencies = new DependenciesIndex();
        $this->stubs = new StubsIndex(); //StubsIndex::read();
        $this->project = new ProjectIndex(
            $this->source, 
            $this->dependencies, 
            $composerJson,
        );
        $this->global = new GlobalIndex($this->stubs, $this->project);
    }
}