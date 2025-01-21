<?php

declare(strict_types=1);

namespace Kiriamcf\Lens\Enums;

/**
 * @internal
 */
enum FileExtension: string
{
    case BLADE = '.blade.php';
    case VUE = '.vue';
    case JSX = '.jsx';
    case TSX = '.tsx';

    /**
     * Returns an array of all the available extensions for the user to choose from.
     */
    public static function commandArray(): array
    {
        return [
            self::BLADE->value => 'Blade',
            self::VUE->value => 'Vue',
            self::JSX->value => 'JSX',
            self::TSX->value => 'TSX',
        ];
    }
}
