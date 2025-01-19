<?php

declare(strict_types=1);

namespace Kiriamcf\Lens\Services;

use DOMDocument;
use DOMElement;
use DOMNodeList;
use Illuminate\Support\Collection;
use Kiriamcf\Lens\Enums\AttributeFormat;
use Kiriamcf\Lens\Enums\HtmlElement;
use SplFileInfo;

final class FileInspector
{
    private DOMDocument $dom;
    private array $logs = [];

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
        collect(HtmlElement::cases())
            ->mapWithKeys(fn (HtmlElement $element) => [$element->value => $this->findDomElements($element)])
            ->filter()
            ->each(fn (DomNodeList $nodes , string $element) => $this->analyzeElement($nodes, $element));
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
            ->each(function (DOMElement $node) use ($elementClass) {
                $neededAttributes = collect($elementClass::neededAttributes());
                $missingAttributes = $neededAttributes->reject(function (string $attribute) use ($node) {
                    return collect(AttributeFormat::cases())
                        ->contains(fn (AttributeFormat $format) => $node->hasAttribute(str_replace('{attribute}', $attribute, $format->toHtml())));
                });
    
                if ($missingAttributes->isNotEmpty()) {
                    array_push($this->logs, "The {$elementClass::name()} element in {$this->file->getFilename()} line {$node->getLineNo()} is missing the following attributes: " . $missingAttributes->implode(', '));
                }
            });
    }
}
