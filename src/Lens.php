<?php

declare(strict_types=1);

namespace Kiriamcf\Lens;

use Illuminate\Support\Facades\File;
use Kiriamcf\Lens\Enums\FileExtension;
use Kiriamcf\Lens\Enums\HtmlElement;
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
     * @param array $extensions
     */
    public function __construct(private array $extensions)
    {
        // 
    }

    /**
     * Begin processing the files.
     * 
     * @return void
     */
    public function handle(): void
    {
        collect(config('lens.resource_folders'))
            ->each(fn (string $folder) => $this->processFolder($folder));
    }

    /**
     * Process the given folder.
     * 
     * @param string $folder
     * @return void
     */
    private function processFolder(string $folder): void
    {
        collect(File::allFiles(resource_path($folder)))
            ->filter(function (SplFileInfo $file) {
                return collect(FileExtension::cases())
                    ->contains(fn (FileExtension $extension) => str_ends_with($file->getFilename(), $extension->value));
            })
            ->each(fn (SplFileInfo $file) => $this->processFile($file));
    }

    /**
     * Process the given folder.
     * 
     * @param SplFileInfo $file
     * @return void
     */
    private function processFile(SplFileInfo $file): void
    {
        $fileInspector = new FileInspector($file);

        $fileInspector->analyze();

        // $fileInspector->report();

        // $fileInspector->save();
    }
}
