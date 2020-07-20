<?php

namespace Apidaze\Builder\Nodes;

use Apidaze\Builder\Nodes\BaseNode;

class SipUri extends BaseNode
{
    protected $name = "sipuri";

    public function __construct(string $sipUri, int $timeout = null)
    {
        $attributes = [];
        if (is_int($timeout)) {
            $attributes["timeout"] = strval($timeout);
        }
        parent::__construct($sipUri, $attributes);
    }
}
