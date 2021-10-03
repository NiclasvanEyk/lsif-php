<?php

namespace NiclasVanEyk\LsifPhp\Lsif\Generation;

class IdGenerator
{
    private int $counter = 1;

    public function next(): int
    {
        return $this->counter++;
    }
}
