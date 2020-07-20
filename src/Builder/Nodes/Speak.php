<?php

namespace Apidaze\Builder\Nodes;

use Apidaze\Builder\Nodes\BaseNode;

/**
 * Say the text enclosed in the tag.
 */
class Speak extends BaseNode
{
    protected $name = 'speak';

    /**
     * Instantiates the Speak node.
     *
     * @param string $text Text to be spoken.
     * @param string $lang The language this text will be spoken. Default is "en-US"
     * @param int $inputTimeout The input timeout in miliseconds.
     * @param int $digitTimeout The digit timeout in miliseconds.
     */
    public function __construct(string $text, string $lang = "en-US", int $inputTimeout = 0, int $digitTimeout = 0)
    {
        $attributes = [
        "lang" => $lang
      ];

        if ($inputTimeout > 0) {
            $attributes["input-timeout"] = strval($inputTimeout);
        }
        if ($digitTimeout > 0) {
            $attributes["digit-timeout"] = strval($digitTimeout);
        }

        parent::__construct($text, $attributes);
    }
}
