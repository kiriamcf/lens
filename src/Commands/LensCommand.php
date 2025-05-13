<?php

namespace Kiriamcf\Lens\Commands;

use Illuminate\Console\Command;
use InvalidArgumentException;
use Kiriamcf\Lens\Enums\Depth;
use Kiriamcf\Lens\Enums\FileExtension;
use Kiriamcf\Lens\Lens;

use function Laravel\Prompts\multiselect;
use function Laravel\Prompts\select;

class LensCommand extends Command
{
    public $signature = 'lens 
        {--extensions= : Comma-separated file extensions}
        {--depth= : Inspection depth}
        {--default= : Default configurations, keep all specified options through the cli}
        {--folder= : Specify a folder to inspect}';

    public $description = 'Execute the lens inspection';

    public function handle(): int
    {
        $extensions = $this->getFileExtensions();

        $depth = $this->getDepth();

        (new Lens($extensions, $depth, $this->option('folder')))->handle();

        return self::SUCCESS;
    }

    /**
     * @return array<FileExtension>
     *
     * @throws InvalidArgumentException
     */
    private function getFileExtensions(): array
    {
        if ($this->option('extensions')) {
            return collect(explode(',', $this->option('extensions')))
                ->map(fn (string $extension) => FileExtension::fromExternal($extension))
                ->toArray();
        }

        if ($this->option('default')) {
            return config('lens.default.extensions', [FileExtension::BLADE]);
        }
        
        return $this->askForFileExtensions();
    }

    private function askForFileExtensions(): array
    {
        return array_map(fn (string $extension) => FileExtension::from($extension),
            multiselect(
                label: 'What file extensions would you like to inspect?',
                options: FileExtension::commandArray(),
                default: [FileExtension::BLADE->value],
                required: true
            )
        );
    }

    /**
     * @throws InvalidArgumentException
     */
    private function getDepth(): Depth
    {
        if ($this->option('depth')) {
            return Depth::fromExternal($this->option('depth'));
        }

        if ($this->option('default')) {
            return config('lens.default.depth', Depth::SHALLOW);
        }
        
        return $this->askForDepth();
    }

    private function askForDepth(): Depth
    {
        return Depth::from(
            select(
                label: 'What depth would you like to apply?',
                options: Depth::commandArray(),
                default: Depth::SHALLOW->value,
                required: true
            )
        );
    }
}
