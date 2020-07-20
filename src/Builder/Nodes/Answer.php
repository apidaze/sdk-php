<?php

namespace Apidaze\Builder\Nodes;

use Apidaze\Builder\Nodes\BaseNode;

/**
 * Answer the call immediately. Useful if your want to play a sound file using the playback tag.
 */
class Answer extends BaseNode
{
    protected $name = 'answer';

    /**
     * Instantiates the Answer node.
     */
    public function __construct()
    {
        parent::__construct(null);
    }
}
