<?php

namespace Apidaze\Builder\Nodes;

use Apidaze\Builder\Nodes\BaseNode;

/**
 * Hangup the call immediately. Important note : when a call is not
 * explicitly hung up, APIdaze will ask for more XML instructions
 * by re-fetching the URL of the external script in case the last instruction
 * has been processed.
 */
class Hangup extends BaseNode
{
    protected $name = 'hangup';

    /**
     * Instantiates the Hangup node.
     */
    public function __construct()
    {
        parent::__construct(null);
    }
}
