<?php

declare(strict_types=1);

namespace Kiriamcf\Lens\Enums;

use Kiriamcf\Lens\Elements\Image;

/**
 * @internal
 */
enum HtmlElement: string
{
    case IMAGE = Image::class;
}
