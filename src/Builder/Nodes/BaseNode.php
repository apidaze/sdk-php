<?php

namespace Apidaze\Builder\Nodes;

use DOMDocument;
use DOMElement;

abstract class BaseNode
{
    protected $name = 'base';
    protected $children = [];
    protected $attributes;

    public function __construct($children, array $attributes = [])
    {
        $this->attributes = $attributes;

        if ($children !== null) {
            $this->children[] = $children;
        }
    }

    public function add(BaseNode $child): BaseNode
    {
        $this->children[] = $child;
        return $this;
    }

    protected function getElement(DOMDocument $document): DOMElement
    {
        $element = $document->createElement($this->name);

        foreach ($this->attributes as $name => $value) {
            if (\is_bool($value)) {
                $value = $value ? 'true' : 'false';
            }
            $element->setAttribute($name, $value);
        }

        foreach ($this->children as $child) {
            if (\is_a($child, 'Apidaze\Builder\Nodes\BaseNode')) {
                $element->appendChild($child->getElement($document));
            } else {
                $element->appendChild($document->createTextNode($child));
            }
        }

        return $element;
    }

    protected function getDocument(): DOMDocument
    {
        $document = new DOMDocument();
        $document->formatOutput = true;
        $child = $this->getElement($document);
        $document->appendChild($child);
        return $document;
    }

    public function __toString(): string
    {
        return $this->getDocument()->saveXML();
    }

    public function asXML(): string
    {
        return (string)$this;
    }

    public function xmlToTest(): string
    {
        $document = new DOMDocument();
        $document->formatOutput = true;
        $document->preserveWhiteSpace = false;
        $child = $this->getElement($document);
        $document->appendChild($child);
        return $document->saveXML($child);
    }

    public function boolToString(bool $booleanVal): string
    {
        return $booleanVal ? "true" : "false";
    }
}
