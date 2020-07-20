<?php

namespace Apidaze\Builder\Nodes;

use Apidaze\Builder\Nodes\BaseNode;

/**
 * Record the call.
 */
class Record extends BaseNode
{
    protected $name = 'record';

    /**
     * Instantiates the Record node.
     *
     * @param string $name The name you want to give to your recording file.
     * NOTE: There is no suffix in your filename, it is
     * automatically suffixed with ".wav". Default is UUID of call.
     * @param bool $onAnswered Starts recording when the call is answered.
     * @param bool $aleg Record the A-leg of the call.. caller to callee.
     * @param bool $bleg Record the B-leg of the call.. callee to caller.
     */
    public function __construct(string $name = null, bool $onAnswered = false, bool $aleg = true, bool $bleg = true)
    {
        $attributes = [
        "on-answered" => $this->boolToString($onAnswered),
        "aleg" => $this->boolToString($aleg),
        "bleg" => $this->boolToString($bleg)
      ];

        if (is_string($name)) {
            $attributes["name"] = $name;
        }
        parent::__construct(null, $attributes);
    }
}
