<?php

declare(strict_types=1);

namespace Kiriamcf\Lens;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Kiriamcf\Lens\Enums\FileExtension;
use Kiriamcf\Lens\Services\FileInspector;
use Kiriamcf\Lens\ValueObjects\Log;
use SplFileInfo;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @internal
 */
final readonly class Lens
{
    /**
     * Creates a new Lens instance.
     */
    public function __construct(private OutputInterface $output, private array $extensions)
    {
        //
    }

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
        $fileInspector = new FileInspector($file);

        $fileInspector->analyze();

        $this->report($fileInspector->getLogs());

        // $fileInspector->save();
    }

    /**
     * Report the logs.
     */
    private function report(Collection $logs): void
    {
        $logs->each(function (Log $log) {
            $this->output->writeln("<info>Warning in file: <comment>{$log->path()}</comment> (Line: {$log->line()})</info>");
            $this->output->writeln("<info> - Element: </info><comment>{$log->element()}</comment>");
            $this->output->writeln('<info> - Missing attributes: </info><comment>'.implode(', ', $log->attributes()).'</comment>');
            $this->output->writeln('');
        });
    }
}
