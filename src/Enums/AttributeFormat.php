<?php

declare(strict_types=1);

namespace Kiriamcf\Lens\Enums;

/**
 * @internal
 */
enum AttributeFormat
{
    case REGULAR;
    case BINDING;

    /**
     * Get the HTML representation of the attribute format.
     */
    public function toHtml(): string
    {
        return match ($this) {
            self::REGULAR => '{attribute}',
            self::BINDING => ':{attribute}',
        };
    }
}
