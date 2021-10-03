<?php

namespace NiclasVanEyk\LsifPhp;

class Version
{
    public static function DEV(): string
    {
        return 'dev-' . date('Y-m-d_H:i:s');
    }
}
