<?php

declare(strict_types=1);

namespace Kiriamcf\Lens\Enums;

/**
 * @internal
 */
enum Depth: int
{
    case SHALLOW = 1;
    case DEEP = 2;

    /**
     * Returns an array of all the available sub-levels for the user to choose from.
     */
    public static function commandArray(): array
    {
        return [
            self::SHALLOW->value => 'Shallow (required attributes)',
            self::DEEP->value => 'Deep (best practices)',
        ];
    }
}
