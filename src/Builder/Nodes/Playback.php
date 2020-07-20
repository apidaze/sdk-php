<?php

namespace Apidaze\Builder\Nodes;

use Apidaze\Builder\Nodes\BaseNode;

/**
 * Play a sound file to the caller, accessible at a URL or locally. The file
 * location can be set as a text enclosed in the tag, or in the “file”
 * attribute. To be accessible locally, the file must have been uploaded
 * using the REST API, see the Media File actions in the API Reference
 * section. The file format must be .wav, sample frequency 8000Hz,
 * 1 channel (mono).
 */
class Playback extends BaseNode
{
    protected $name = 'playback';

    /**
     * Instantiates the Playback node.
     *
     * @param string $file The file location of the wav file to play.
     */
    public function __construct(string $file)
    {
        parent::__construct($file);
    }
}
