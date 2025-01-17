<?php

declare(strict_types=1);

namespace Kiriamcf\Lens\Services;

use DOMDocument;
use SplFileInfo;

final readonly class FileInspector
{
    private DOMDocument $dom;

    /**
     * Creates a new FileInspector instance.
     */
    public function __construct(private SplFileInfo $file)
    {
        $this->dom = new DOMDocument;

        $this->loadContents();
    }

    /**
     * Analyze the file.
     */
    public function analyze(): void
    {
        //
    }

    /**
     * Load the contents of the file into the DOM.
     */
    private function loadContents(): void
    {
        libxml_use_internal_errors(true);

        $this->dom->loadHTML(file_get_contents($this->file->getRealPath()));

        libxml_clear_errors();
    }
}
