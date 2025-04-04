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
     */
    public static function name(): string;

    /**
     * Return the needed attributes for this field.
     */
    public static function neededAttributes(): array;

    /**
     * Return the attributes added by default for this field.
     */
    public static function defaultAttributes(): array;
}
