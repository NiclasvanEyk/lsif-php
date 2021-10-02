<?php

namespace NiclasVanEyk\LsifPhp\Dump;

class IdGenerator
{
    private int $counter = 0;

    public function next(): int
    {
        return $this->counter++;
    }
}