<?php

use Kiriamcf\Lens\Enums\Depth;
use Kiriamcf\Lens\Enums\FileExtension;

return [
    'folders' => [
        './resources/views/',
    ],
    'default' => [
        'extensions' => [
            FileExtension::BLADE,
        ],
        'depth' => Depth::SHALLOW,
    ],
];
