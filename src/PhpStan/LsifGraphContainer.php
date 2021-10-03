<?php

namespace NiclasVanEyk\LsifPhp\PhpStan;

use NiclasVanEyk\LsifPhp\Lsif\Generation\LsifDumpContainer;

class LsifGraphContainer
{
    protected static ?LsifGraphContainer $graph;

    public function get(): LsifGraphContainer
    {
        return self::$graph;
    }

    public function set(LsifGraphContainer $graph)
    {
        self::$graph = $graph;
    }
}
