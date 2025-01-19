<?php

declare(strict_types=1);

namespace Kiriamcf\Lens\Elements;

use Kiriamcf\Lens\Contracts\HtmlElement;

/**
 * @internal
 */
class Form implements HtmlElement
{
    /**
     * Return the HTML element name.
     */
    public static function name(): string
    {
        return 'form';
    }

    /**
     * Return the needed attributes for this field.
     */
    public static function neededAttributes(): array
    {
        return ['action', 'method'];
    }
}
