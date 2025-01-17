<?php

declare(strict_types=1);

namespace Kiriamcf\Lens\Contracts;

/**
 * @internal
 */
interface HtmlElement
{
    /**
     * Return the HTML element.
     * 
     * @return string
     */
    public static function name(): string;

    /**
     * Return the needed features for this field.
     * 
     * @return array
     */ 
    public static function neededFeatures(): array;
}