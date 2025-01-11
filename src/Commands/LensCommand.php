<?php

namespace Kiriamcf\Lens\Commands;

use Illuminate\Console\Command;

class LensCommand extends Command
{
    public $signature = 'lens';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
