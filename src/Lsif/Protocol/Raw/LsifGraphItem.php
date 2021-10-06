<?php

namespace NiclasVanEyk\LsifPhp\Lsif\Protocol\Raw;

abstract class LsifGraphItem
{
    public int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return array<mixed>
     */
    abstract public function toArray(): array;
}
