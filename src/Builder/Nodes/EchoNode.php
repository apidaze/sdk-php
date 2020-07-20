<?php

namespace Apidaze\Builder\Nodes;

use Apidaze\Builder\Nodes\BaseNode;

/**
 * Echo back received audio to the caller with some delay.
 */
class EchoNode extends BaseNode
{
    protected $name = 'echo';

    /**
     * Instantiates the Echo node.
     *
     * @param int $delay Delay in miliseconds.
     */
    public function __construct(int $delay)
    {
        parent::__construct(strval($delay));
    }
}
