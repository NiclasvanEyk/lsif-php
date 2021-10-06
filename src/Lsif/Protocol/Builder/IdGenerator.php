<?php

namespace NiclasVanEyk\LsifPhp\Lsif\Protocol\Builder;

interface IdGenerator
{
    public function nextId(): int;
}
