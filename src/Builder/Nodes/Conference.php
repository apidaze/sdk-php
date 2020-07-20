<?php

namespace Apidaze\Builder\Nodes;

use Apidaze\Builder\Nodes\BaseNode;

/**
 * Join an audio conference.
 */
class Conference extends BaseNode
{
    protected $name = 'conference';

    /**
     * Instantiates the Conference node.
     *
     * @param string $room Meeting room to join.
     */
    public function __construct(string $room)
    {
        parent::__construct($room);
    }
}
