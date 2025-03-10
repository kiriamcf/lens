<?php

declare(strict_types=1);

namespace Kiriamcf\Lens\Services;

use Illuminate\Support\Collection;
use Kiriamcf\Lens\ValueObjects\Log;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @internal
 */
final class Displayer
{
    /**
     * Creates a new Displayer instance.
     */
    public function __construct(private OutputInterface $output) {}

    /**
     * Get the output.
     */
    public function output(): OutputInterface
    {
        return $this->output;
    }

    /**
     * Dump the logs.
     *
     * @param  Collection<Log>  $logs
     */
    public function dump(Collection $logs): void
    {
        $logs->each(fn (Log $log) => $this->dumpLog($log));
    }

    /**
     * Dump the log.
     */
    private function dumpLog(Log $log): void
    {
        $this->output->writeln("<info>Warning in file: <comment>{$log->path()}</comment> (Line: {$log->line()})</info>");
        $this->output->writeln("<info> - Element: </info><comment>{$log->element()}</comment>");

        if (! empty($log->missingAttributes())) {
            $this->output->writeln('<info> - Missing attributes: </info><comment>'.implode(', ', $log->missingAttributes()).'</comment>');
        }

        if (! empty($log->recommendedAttributes())) {
            $this->output->writeln('<info> - Recommended attributes: </info><comment>'.implode(', ', $log->recommendedAttributes()).'</comment>');
        }

        $this->output->writeln('');
    }
}
