<?php

namespace Apidaze\Builder\Nodes;

use Apidaze\Builder\Nodes\BaseNode;
use Apidaze\Builder\Nodes\Number;
use Apidaze\Builder\Nodes\SipAccount;
use Apidaze\Builder\Nodes\SipUri;

abstract class DialTargetType
{
    public const number = 1;
    public const sipacount = 2;
    public const sipuri = 3;
}

abstract class DialStrategy
{
    public const simultaneous = "simultaneous";
    public const sequence = "sequence";
}

/**
 * Place a call to a destination. A destination can be an external number,
 * a SIP account or a voicemail box. Multiple destinations can be dialed
 * simultaneously or in sequence.
 */
class Dial extends BaseNode
{
    protected $name = 'dial';

    /**
     * Instantiates the Dial node.
     *
     * @param string $destination Call destination. Can be number, sipaccount or sipuri.
     * @param DialTargetType $targetType Choose from between number, sipaccount or sipuri.
     * @param int $timeout The maximum time (in seconds) to ring the call destination. Default is 60.
     * @param int $maxCallDuration The maximum time (in seconds) for this call. The corresponding timer starts when the call is answered.
     * @param DialStrategy $strategy When dialing multiple destinations, ring them in sequence or simultaneously.
     * @param string $action The URL of the external script to fetch when the callee ends the current call.
     * @param string $answerUrl A URL containing XML instructions to run on the callee side when the callee answers the call, and before establishing the call with the caller.
     * @param string $callerHangupUrl A URL containing XML instructions to run on the callee side when the caller hangs up.
     * @param int $attribTimeout The maximum time (in seconds) to ring the call for a specific number. Default null.
     */
    public function __construct(string $destination, int $targetType, int $timeout = 60, int $maxCallDuration = null, string $strategy = DialStrategy::simultaneous, string $action = null, string $answerUrl = null, string $callerHangupUrl = null, string $attribTimeout = null)
    {
        $attributes = [
        "timeout" => strval($timeout),
        "strategy" => $strategy
      ];
        if (is_int($maxCallDuration)) {
            $attributes["max-call-duration"] = strval($maxCallDuration);
        }
        if (is_string($action)) {
            $attributes["action"] = $action;
        }
        if (is_string($answerUrl)) {
            $attributes["answer-url"] = $answerUrl;
        }
        if (is_string($callerHangupUrl)) {
            $attributes["caller-hangup-url"] = $callerHangupUrl;
        }

        $child = null;
        if ($targetType == DialTargetType::number) {
            $child = new Number($destination, $attribTimeout);
        } elseif ($targetType == DialTargetType::sipacount) {
            $child = new SipAccount($destination, $attribTimeout);
        } else {
            $child = new SipUri($destination, $attribTimeout);
        }

        parent::__construct($child, $attributes);
    }
}
