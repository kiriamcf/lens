<?php

namespace Kiriamcf\Lens\Commands;

use Illuminate\Console\Command;
use Kiriamcf\Lens\Enums\FileExtension;
use Kiriamcf\Lens\Lens;
use function Laravel\Prompts\multiselect;
use function Laravel\Prompts\info;

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
            )
        );

        $lens = new Lens(output: $this->output, extensions: $extensions);

        $lens->handle();

        // Ask if they want to fix the issues

        // Fix the issues

        // Show results

        info('All files containing the selected extensions have been analyzed.');

        return self::SUCCESS;
    }
}
