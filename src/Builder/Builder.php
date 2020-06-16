<?php

namespace Apidaze\Builder;

use Apidaze\Builder\Nodes\BaseNode;
use Apidaze\Builder\Nodes\Work;

use DOMDocument;

class Builder extends BaseNode
{
    protected $name = 'document';

    public function __construct($attributes = [])
    {
        parent::__construct(null, []);

        $this->attributes = $attributes;

        $this->children = [new Work($attributes)];
    }

    public function add(BaseNode $child): BaseNode
    {
        if ($child) {
            $this->children[0]->add($child);
        }

        return $this;
    }

    protected function getDocument(): DOMDocument
    {
        $document = new DOMDocument();
        $document->formatOutput = true;
        $child = $this->getElement($document);
        $document->appendChild($child);
        return $document;
    }
}
