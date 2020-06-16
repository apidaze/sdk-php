<?php

namespace Apidaze\Rest;

use Apidaze\Rest\HttpClient;
use Apidaze\Rest\HttpMethods;

/**
 * A client for accessing the Messages related endpoints.
 *
 * @package Apidaze\Rest
 */
class Messages
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
    protected $endpoint = '/sms/send';

    /**
     * Instantiates a Messages client.
     *
     * @param HttpClient $http A pre-authenticated HTTP client to consume
     */
    public function __construct(HttpClient $http)
    {
        $this->http = $http;
    }

    /**
     * Sends SMS to destination
     *
     * @param string $origin The number to send the text from. Must be an active number on your account.
     * @param string $destination Destination number (no + sign).
     * @param string $body The message to send.
     *
     * @return array The response
     */
    public function send(string $origin, string $destination, string $body)
    {
        $params = [
        "to" => $destination,
        "from" => $origin,
        "body" => $body
      ];
      
        return $this->http->request(HttpMethods::POST, $this->endpoint, $params);
    }
}
