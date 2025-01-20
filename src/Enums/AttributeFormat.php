<?php

declare(strict_types=1);

namespace Kiriamcf\Lens\Enums;

/**
 * @internal
 * 
 * @see https://laravel.com/docs/11.x/blade#escaping-attribute-rendering
 * @see https://vuejs.org/guide/essentials/class-and-style.html
 * @see https://alpinejs.dev/directives/bind
 */
enum AttributeFormat
{
    case REGULAR;
    case GENERIC_BINDING;
    case LARAVEL_ESCAPED;
    case VUE_BINDING;
    case ALPINEJS_BINDING;

    /**
     * Get the HTML representation of the attribute format.
     */
    public function toHtml(): string
    {
        return match ($this) {
            self::REGULAR => '{attribute}',
            self::GENERIC_BINDING => ':{attribute}',
            self::LARAVEL_ESCAPED => '::{attribute}',
            self::VUE_BINDING => 'v-bind:{attribute}',
            self::ALPINEJS_BINDING => 'x-bind:{attribute}',
        };
    }
}
