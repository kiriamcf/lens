<?php

declare(strict_types=1);

namespace Kiriamcf\Lens\ValueObjects;

/**
 * @internal
 */
final readonly class Log
{
    /**
     * Creates a new Log instance.
     */
    public function __construct(
        private string $path,
        private int $line,
        private string $element,
        private array $missingAttributes,
        private array $recommendedAttributes
    ) {}

    /**
     * Get the path of the file.
     */
    public function path(): string
    {
        return $this->path;
    }

    /**
     * Get the line number of the issue.
     */
    public function line(): int
    {
        return $this->line;
    }

    /**
     * Get the element that has the issue.
     */
    public function element(): string
    {
        return $this->element;
    }

    /**
     * Get the attributes that have the issue.
     */
    public function missingAttributes(): array
    {
        return $this->missingAttributes;
    }

    /**
     * Get the attributes that have the issue.
     */
    public function recommendedAttributes(): array
    {
        return $this->recommendedAttributes;
    }
}
