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
    case HTML = '.html';

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
            self::HTML->value => 'HTML',
        ];
    }

    /**
     * Returns the enum value from an external string.
     *
     * @throws InvalidArgumentException
     */
    public static function fromExternal(string $extension): self
    {
        return match ($extension) {
            'blade', 'Blade', 'BLADE' => self::BLADE,
            'vue', 'Vue', 'VUE' => self::VUE,
            'jsx', 'Jsx', 'JSX' => self::JSX,
            'tsx', 'Tsx', 'TSX' => self::TSX,
            'html', 'Html', 'HTML' => self::HTML,
            default => throw new InvalidArgumentException("Invalid file extension: {$extension}"),
        };
    }
}
