<?php

declare(strict_types=1);

namespace Kiriamcf\Lens\Enums;

use InvalidArgumentException;

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

    /**
     * Returns the enum value from an external string.
     */
    public static function fromExternal(string $extension): self
    {
        return match ($extension) {
            'blade', 'Blade', 'BLADE' => self::BLADE,
            'vue', 'Vue', 'VUE' => self::VUE,
            'jsx', 'Jsx', 'JSX' => self::JSX,
            'tsx', 'Tsx', 'TSX' => self::TSX,
            default => throw new InvalidArgumentException("Invalid file extension: {$extension}"),
        };
    }
}
