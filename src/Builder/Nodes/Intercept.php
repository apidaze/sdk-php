<?php

namespace Apidaze\Builder\Nodes;

use Apidaze\Builder\Nodes\BaseNode;

/**
 * Intercept a channel. The channel is identified by a UUID parameter that
 * must have been stored in some way by your script. You can map this
 * application with a dialing sequence (e.g. : *8) to implement group-pickup
 * or directed-pickup functions.
 */
class Intercept extends BaseNode
{
    protected $name = 'intercept';

    /**
     * Instantiates the Intercept node.
     *
     * @param string $uuid UUID of the channel to be intercepted.
     */
    public function __construct(string $uuid)
    {
        parent::__construct($uuid);
    }
}
