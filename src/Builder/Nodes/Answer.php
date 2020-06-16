<?php


namespace Apidaze\Builder\Nodes;

use Apidaze\Builder\Nodes\BaseNode;

class Answer extends BaseNode
{
    protected $name = 'answer';

    public function __construct(array $attributes = [])
    {
        parent::__construct(null, $attributes);
    }
}
