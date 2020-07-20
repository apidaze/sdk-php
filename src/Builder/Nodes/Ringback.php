<?php

namespace Apidaze\Builder\Nodes;

use Apidaze\Builder\Nodes\BaseNode;

/**
 * Play a ringback tone or file to the caller. This action is non-blocking,
 * that is, the next XML instrunction will be executed without waiting. This
 * can be useful for example if you want to play a custom file with dialing
 * a number.
 *
 * If the enclosed text of the tag is empty, the regular ringback tone
 * is played.
 *
 * The file format must be .wav, sample frequency 8000Hz, 1 channel (mono).
 */
class Ringback extends BaseNode
{
    protected $name = 'ringback';

    /**
     * Instantiates the Ringback node.
     *
     * @param string $file The file location of the wav file to play
     */
    public function __construct(string $file)
    {
        parent::__construct($file);
    }
}
