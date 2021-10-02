<?php

namespace NiclasVanEyk\LsifPhp;

interface LsifGenerator
{
    public function __construct(string $rootPath);
    public function generate(): void;
}