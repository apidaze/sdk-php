<?php


namespace Apidaze\Builder\Nodes;

use Apidaze\Builder\Nodes\BaseNode;

class Record extends BaseNode
{
    protected $name = 'record';

    public function __construct(array $attributes = [])
    {
        parent::__construct(null, $attributes);
    }
}
