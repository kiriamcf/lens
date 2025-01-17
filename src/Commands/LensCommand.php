<?php

namespace Kiriamcf\Lens\Commands;

use Illuminate\Console\Command;
use Kiriamcf\Lens\Enums\FileExtension;
use Kiriamcf\Lens\Lens;

class LensCommand extends Command
{
    public $signature = 'lens';

    public $description = 'My command';

    public function handle(): int
    {
        // Ask for extensions to process

        $lens = new Lens([FileExtension::BLADE]);

        $lens->handle();

        // Show results

        // Ask if they want to fix the issues

        // Fix the issues

        // Show results

        $this->comment('All done');

        return self::SUCCESS;
    }
}
