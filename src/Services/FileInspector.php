<?php

declare(strict_types=1);

namespace Kiriamcf\Lens\Services;

use DOMDocument;
use DOMElement;
use DOMNode;
use DOMNodeList;
use Illuminate\Support\Collection;
use Kiriamcf\Lens\Enums\AttributeFormat;
use Kiriamcf\Lens\Enums\Depth;
use Kiriamcf\Lens\Enums\HtmlElement;
use Kiriamcf\Lens\ValueObjects\Log;
use SplFileInfo;

/**
 * @internal
 */
final class FileInspector
{
    private DOMDocument $dom;

    private array $logs = [];

    /**
     * Creates a new FileInspector instance.
     */
    public function __construct(private SplFileInfo $file, private Depth $depth)
    {
        $this->dom = new DOMDocument;

        $this->loadContents();
    }

    /**
     * Analyze the file.
     */
    public function analyze(): void
    {
        collect(HtmlElement::cases())
            ->mapWithKeys(fn (HtmlElement $element) => [$element->value => $this->findDomElements($element)])
            ->filter()
            ->each(fn (DomNodeList $nodes, string $element) => $this->analyzeElement($nodes, $element));
    }

    /**
     * Get the logs from the analysis.
     */
    public function getLogs(): Collection
    {
        return collect($this->logs);
    }

    /**
     * Load the contents of the file into the DOM.
     */
    private function loadContents(): void
    {
        libxml_use_internal_errors(true);

        $this->dom->loadHTML(file_get_contents($this->file->getRealPath()), LIBXML_COMPACT);

        libxml_clear_errors();
    }

    /**
     * Find the DOM elements in the file.
     */
    private function findDomElements(HtmlElement $element): ?DOMNodeList
    {
        $elements = $this->dom->getElementsByTagName($element->value::name());

        return $elements->count() === 0 ? null : $elements;
    }

    /**
     * Analyze the element in each node.
     */
    private function analyzeElement(DomNodeList $nodes, string $elementClass): void
    {
        collect(iterator_to_array($nodes))
            ->filter(fn (DOMNode $node) => $node instanceof DOMElement)
            ->each(fn (DOMElement $node) => $this->logMissingAttributes($node, $elementClass));
    }

    /**
     * Logs missing or recommended attributes for a given element if any are found.
     */
    private function logMissingAttributes(DOMElement $node, string $elementClass): void
    {
        $required = $this->getMissingAttributes(
            node: $node,
            attributes: collect($elementClass::neededAttributes())
        );

        $recommended = $this->depth->value >= Depth::DEEP->value
            ? $this->getMissingAttributes(
                node: $node,
                attributes: collect($elementClass::defaultAttributes())
            )
            : collect();

        if ($required->isEmpty() && $recommended->isEmpty()) {
            return;
        }

        array_push($this->logs, new Log(
            element: $elementClass::name(),
            path: $this->file->getPathname(),
            line: $node->getLineNo(),
            missingAttributes: $required->toArray(),
            recommendedAttributes: $recommended->toArray()
        ));
    }

    /**
     * Determines which attributes are missing from the given element.
     */
    private function getMissingAttributes(DOMElement $node, Collection $attributes): Collection
    {
        return $attributes->reject(fn (string $attribute) => collect(AttributeFormat::cases())->contains(
            fn (AttributeFormat $format) => $node->hasAttribute(str_replace('{attribute}', $attribute, $format->toHtml()))
        )
        );
    }
}
