<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Folders
    |--------------------------------------------------------------------------
    |
    | The list of folders to be inspected when running the lens command.
    | If the command is run with the --folder option, this list will
    | be ignored. Only use this as a default configuration.
    |
    */

    'folders' => ['./resources/views/'],

    /*
    |--------------------------------------------------------------------------
    | Extensions
    |--------------------------------------------------------------------------
    |
    | The list of file extensions that lens will include in the inspection.
    | If the command is run with the --extensions option, this list will
    | be ignored. Only use this as a default configuration.
    |
    | Supported extensions: "blade", "vue", "jsx", "tsx", "html"
    |
    */

    'extensions' => ['blade'],

    /*
    |--------------------------------------------------------------------------
    | Depth
    |--------------------------------------------------------------------------
    |
    | The depth of the inspection. This will determine how strict the inspection
    | will be. Shallow inspection will check only the essential missing
    | attributes, while the deep inspection will also take into
    | consideration best practices. If the command is run with
    | the --extensions option, this list will be ignored.
    | Only use this as a default configuration.
    |
    | Supported depths: "shallow", "deep"
    |
    */

    'depth' => 'shallow',
];
