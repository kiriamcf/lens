<?php

declare(strict_types=1);

namespace Kiriamcf\Lens;

use Illuminate\Support\Facades\File;
use Kiriamcf\Lens\Enums\Depth;
use Kiriamcf\Lens\Enums\FileExtension;
use Kiriamcf\Lens\Services\Displayer;
use Kiriamcf\Lens\Services\FileInspector;
use SplFileInfo;

/**
 * @internal
 */
final readonly class Lens
{
    /**
     * Creates a new Lens instance.
     *
     * @param  $extensions  array<FileExtension>
     */
    public function __construct(
        private array $extensions,
        private Depth $depth
    ) {}

    /**
     * Begin processing the files.
     */
    public function handle(): void
    {
        collect(config('lens.folders'))
            ->each(fn (string $folder) => $this->processFolder($folder));
    }

    /**
     * Process the given folder.
     */
    private function processFolder(string $folder): void
    {
        collect(File::allFiles($folder))
            ->filter(function (SplFileInfo $file) {
                return collect($this->extensions)
                    ->contains(fn (FileExtension $extension) => str_ends_with($file->getFilename(), $extension->value));
            })
            ->each(fn (SplFileInfo $file) => $this->processFile($file));
    }

    /**
     * Process the given folder.
     */
    private function processFile(SplFileInfo $file): void
    {
        $fileInspector = new FileInspector($file, $this->depth);

        $fileInspector->analyze();

        app(Displayer::class)->dump($fileInspector->getLogs());
    }
}
