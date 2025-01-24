<?php

declare(strict_types=1);

namespace Kiriamcf\Lens\Enums;

use Kiriamcf\Lens\Elements\Anchor;
use Kiriamcf\Lens\Elements\Button;
use Kiriamcf\Lens\Elements\Form;
use Kiriamcf\Lens\Elements\Iframe;
use Kiriamcf\Lens\Elements\Image;
use Kiriamcf\Lens\Elements\Input;
use Kiriamcf\Lens\Elements\Link;
use Kiriamcf\Lens\Elements\Script;
use Kiriamcf\Lens\Elements\Source;
use Kiriamcf\Lens\Elements\Track;

/**
 * @internal
 */
enum HtmlElement: string
{
    case ANCHOR = Anchor::class;
    case BUTTON = Button::class;
    case FORM = Form::class;
    case IFRAME = Iframe::class;
    case IMAGE = Image::class;
    case INPUT = Input::class;
    case LINK = Link::class;
    case SCRIPT = Script::class;
    case SOURCE = Source::class;
    case TRACK = Track::class;
}
