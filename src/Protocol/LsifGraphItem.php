<?php

namespace NiclasVanEyk\LsifPhp\Protocol;

abstract class LsifGraphItem
{
    public int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    abstract public function toArray(): array;
}