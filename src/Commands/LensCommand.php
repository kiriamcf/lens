<?php

namespace Kiriamcf\Lens\Commands;

use Illuminate\Console\Command;
use Kiriamcf\Lens\Enums\Depth;
use Kiriamcf\Lens\Enums\FileExtension;
use Kiriamcf\Lens\Lens;

use function Laravel\Prompts\multiselect;
use function Laravel\Prompts\select;

class LensCommand extends Command
{
    public $signature = 'lens';

    public $description = 'My command';

    public function handle(): int
    {
        $extensions = array_map(fn (string $extension) => FileExtension::from($extension),
            multiselect(
                label: 'What file extensions would you like to inspect?',
                options: FileExtension::commandArray(),
                default: [FileExtension::BLADE->value],
                required: true
            )
        );

        $depth = Depth::from(
            select(
                label: 'What depth would you like to apply?',
                options: Depth::commandArray(),
                default: Depth::SHALLOW->value,
                required: true
            )
        );

        (new Lens($extensions, $depth))->handle();

        return self::SUCCESS;
    }
}
