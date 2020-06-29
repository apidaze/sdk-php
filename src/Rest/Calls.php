<?php

namespace Apidaze\Rest;

use Apidaze\Rest\CallType;
use Apidaze\Rest\HttpClient;
use Apidaze\Rest\HttpMethods;

/**
 * A client for accessing the Calls related endpoints.
 *
 * @package Apidaze\Rest
 */
class Calls
{
    /**
     * A HTTP client
     *
     * @var \Apidaze\Rest\HttpClient
     */
    protected $http;

    /**
     * The base path to the endpoint(s) for the respective client
     *
     * @var string
     */
    protected $endpoint = '/calls';

    /**
     * Instantiates a Calls client.
     *
     * @param HttpClient $http A pre-authenticated HTTP client to consume
     */
    public function __construct(HttpClient $http)
    {
        $this->http = $http;
    }

    /**
     * Shows active calls list
     *
     * @return array The response
     */
    public function list()
    {
        return $this->http->request(HttpMethods::GET, $this->endpoint);
    }

    /**
     * Places a call to a phone number or SIP account
     *
     * @param string $callerId The phone number to present as the callerid (country code included, no + sign)
     * @param string $origin The phone number or SIP account to ring first.
     * @param string $destination The destination passed as a parameter to your External Script URL.
     * @param CallType $callType The type of the terminal to ring first. Options: CallType::number or CallType::sipaccount.
     *
     * @return array The response
     */
    public function place(string $calledId, string $origin, string $destination, string $callType)
    {
        $payload = [
        'callerid' => $calledId,
        'origin' => $origin,
        'destination' => $destination,
        'type' => $callType
      ];
      
        return $this->http->request(HttpMethods::POST, $this->endpoint, $payload);
    }

    /**
     * Shows active call with specific UUID
     *
     * @param string $uuid UUID of active call
     *
     * @return array The response
     */
    public function get(string $uuid)
    {
        return $this->http->request(HttpMethods::GET, $this->endpoint . "/" . $uuid);
    }

    /**
     * Hangs up active call with UUID
     *
     * @param string $uuid UUID of active call
     *
     * @return array The response
     */
    public function terminate(string $uuid)
    {
        return $this->http->request(HttpMethods::DELETE, $this->endpoint . "/" . $uuid);
    }
}
