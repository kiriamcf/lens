<?php

use Kiriamcf\Lens\Enums\FileExtension;
use Kiriamcf\Lens\Enums\Depth;

return [
    'folders' => [
        './resources/views/',
    ],
    'default' => [
        'extensions' => [
            FileExtension::BLADE,
        ],
        'depth' => Depth::SHALLOW,
    ]
];
