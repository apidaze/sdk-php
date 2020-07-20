<?php

namespace Apidaze\Builder\Nodes;

use Apidaze\Builder\Nodes\BaseNode;

class SipAccount extends BaseNode
{
    protected $name = "sipaccount";

    public function __construct(string $sipAccount, int $timeout = null)
    {
        $attributes = [];
        if (is_int($timeout)) {
            $attributes["timeout"] = strval($timeout);
        }
        parent::__construct($sipAccount, $attributes);
    }
}
