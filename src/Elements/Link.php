<?php

declare(strict_types=1);

namespace Kiriamcf\Lens\Elements;

use Kiriamcf\Lens\Contracts\HtmlElement;

/**
 * @internal
 */
class Link implements HtmlElement
{
    /**
     * Return the HTML element name.
     */
    public static function name(): string
    {
        return 'link';
    }

    /**
     * Return the needed attributes for this field.
     */
    public static function neededAttributes(): array
    {
        return ['href', 'rel'];
    }

    /**
     * Return the attributes added by default for this field.
     */
    public static function defaultAttributes(): array
    {
        return ['type'];
    }
}
