<?php

namespace Apidaze\Builder\Nodes;

use Apidaze\Builder\Nodes\BaseNode;

class Number extends BaseNode
{
    protected $name = "number";

    public function __construct(string $number, int $timeout = null)
    {
        $attributes = [];
        if (is_int($timeout)) {
            $attributes["timeout"] = strval($timeout);
        }
        parent::__construct($number, $attributes);
    }
}
