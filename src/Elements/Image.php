<?php

declare(strict_types=1);

namespace Kiriamcf\Lens\Elements;

use Kiriamcf\Lens\Contracts\HtmlElement;

/**
 * @internal
 */
class Image implements HtmlElement
{
    /**
     * Return the HTML element name.
     * 
     * @return string
     */
    public static function name(): string
    {
        return 'img';
    }

    /**
     * Return the needed features for this field.
     * 
     * @return array
     */ 
    public static function neededFeatures(): array
    {
        return ['src', 'alt'];
    }
}