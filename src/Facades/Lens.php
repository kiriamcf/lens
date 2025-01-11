<?php

namespace Kiriamcf\Lens\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Kiriamcf\Lens\Lens
 */
class Lens extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Kiriamcf\Lens\Lens::class;
    }
}
