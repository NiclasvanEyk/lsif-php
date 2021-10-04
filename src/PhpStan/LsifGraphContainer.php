<?php

namespace NiclasVanEyk\LsifPhp\PhpStan;

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
