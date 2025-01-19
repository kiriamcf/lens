<?php

declare(strict_types=1);

namespace Kiriamcf\Lens\Enums;

use Kiriamcf\Lens\Elements\Anchor;
use Kiriamcf\Lens\Elements\Form;
use Kiriamcf\Lens\Elements\Image;
use Kiriamcf\Lens\Elements\Input;
use Kiriamcf\Lens\Elements\Link;

/**
 * @internal
 */
enum HtmlElement: string
{
    case ANCHOR = Anchor::class;
    case FORM = Form::class;
    case IMAGE = Image::class;
    case INPUT = Input::class;
    case LINK = Link::class;
}
