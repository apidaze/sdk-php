<?php

namespace Apidaze\Builder\Nodes;

use Apidaze\Builder\Nodes\BaseNode;

class Work extends BaseNode
{
    protected $name = 'work';

    public function __construct(array $attributes = [])
    {
        parent::__construct(null, $attributes);
    }
}
