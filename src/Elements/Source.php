<?php

declare(strict_types=1);

namespace Kiriamcf\Lens\Elements;

use Kiriamcf\Lens\Contracts\HtmlElement;

/**
 * @internal
 */
class Source implements HtmlElement
{
    /**
     * Return the HTML element name.
     */
    public static function name(): string
    {
        return 'source';
    }

    /**
     * Return the needed attributes for this field.
     */
    public static function neededAttributes(): array
    {
        return ['src'];
    }

    /**
     * Return the attributes added by default for this field.
     */
    public static function defaultAttributes(): array
    {
        return ['type'];
    }
}
