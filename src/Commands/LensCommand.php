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
        {--folder= : Specify a folder to inspect}
        {--default : Default configurations, keep all specified options through the cli}';

    public $description = 'Execute the lens inspection';

    public function handle(): int
    {
        $extensions = $this->fileExtensions();

        $depth = $this->depth();

        $folders = $this->folders();

        $dumps = (new Lens($extensions, $depth, $folders))->handle();

        return $dumps != 0
            ? self::FAILURE
            : self::SUCCESS;
    }

    /**
     * @return array<FileExtension>
     *
     * @throws InvalidArgumentException
     */
    private function fileExtensions(): array
    {
        if ($this->option('extensions')) {
            return collect(explode(',', $this->option('extensions')))
                ->map(fn (string $extension) => FileExtension::fromExternal($extension))
                ->toArray();
        }

        if ($this->option('default')) {
            return collect(config('lens.extensions'))
                ->map(fn (string $extension) => FileExtension::fromExternal($extension))
                ->toArray();
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
    private function depth(): Depth
    {
        if ($this->option('depth')) {
            return Depth::fromExternal($this->option('depth'));
        }

        if ($this->option('default')) {
            return Depth::fromExternal(config('lens.depth'));
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

    private function folders(): array
    {
        if ($this->option('folder')) {
            return [$this->option('folder')];
        }

        return config('lens.folders');
    }
}
