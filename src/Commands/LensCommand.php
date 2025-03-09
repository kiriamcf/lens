<?php

namespace Kiriamcf\Lens\Commands;

use InvalidArgumentException;
use Illuminate\Console\Command;
use Kiriamcf\Lens\Enums\Depth;
use Kiriamcf\Lens\Enums\FileExtension;
use Kiriamcf\Lens\Lens;

use function Laravel\Prompts\multiselect;
use function Laravel\Prompts\select;

class LensCommand extends Command
{
    public $signature = 'lens 
        {--extensions= : Comma-separated file extensions}
        {--depth= : Inspection depth}';

    public $description = 'My command';

    public function handle(): int
    {
        $extensions = $this->getFileExtensions();

        $depth = $this->getDepth();

        (new Lens($extensions, $depth))->handle();

        return self::SUCCESS;
    }

    /** 
     * @throws InvalidArgumentException
     * @return array<FileExtension>
     */
    private function getFileExtensions(): array
    {
        if (is_null($this->option('extensions'))) {
            return $this->askForFileExtensions();
        }

        return collect(explode(',', $this->option('extensions')))
            ->map(fn (string $extension) => FileExtension::fromExternal($extension))
            ->toArray();
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
        if (is_null($this->option('depth'))) {
            return $this->askForDepth();
        }

        return Depth::fromExternal($this->option('depth'));
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
