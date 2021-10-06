<?php

namespace NiclasVanEyk\LsifPhp\Lsif\Generation;

class IdGenerator implements \NiclasVanEyk\LsifPhp\Lsif\Protocol\Builder\IdGenerator
{
    private int $counter = 1;

    public function nextId(): int
    {
        return $this->counter++;
    }
}
