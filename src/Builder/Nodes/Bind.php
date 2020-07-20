<?php

namespace Apidaze\Builder\Nodes;

use Apidaze\Builder\Nodes\BaseNode;

/**
 * Get the digits dialed, and take an action. Digits are accepted,
 * and regular expressions too, the XML text must then start with ~.
 * The bind tag is a sub-tag of the playback and speak tags.
 * NOTE: Once the digits match a bind statement they are passed as URL
 * parameter "dialed_digits" to the URL specified in the action attribute
 * of your code.
 */
class Bind extends BaseNode
{
    protected $name = 'bind';

    /**
     * Instantiates the Bind node.
     *
     * @param string $text Digit or regular expression
     * @param string $action The URL to fetch if the digit matches
     */
    public function __construct(string $text, string $action)
    {
        $attributes = [
        "action" => $action
      ];
        parent::__construct($text, $attributes);
    }
}
