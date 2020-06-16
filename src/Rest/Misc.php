<?php

namespace Apidaze\Rest;

use Apidaze\Rest\HttpClient;
use Apidaze\Rest\HttpMethods;

/**
 * A client for accessing the Miscellaneous related endpoints.
 *
 * @package Apidaze\Rest
 */
class Misc
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
    protected $endpoint = '/validates';

    /**
     * Instantiates a Miscellaneous client.
     *
     * @param HttpClient $http A pre-authenticated HTTP client to consume
     */
    public function __construct(HttpClient $http)
    {
        $this->http = $http;
    }

    /**
     * Validates if the provided API key and secret pair is valid
     *
     * @return array The response
     */
    public function validate()
    {
        return $this->http->request(HttpMethods::GET, $this->endpoint);
    }
}
