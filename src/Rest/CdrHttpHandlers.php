<?php

namespace Apidaze\Rest;

use Apidaze\Rest\HttpClient;
use Apidaze\Rest\HttpMethods;

/**
 * A client for accessing the Cdr Http Handler related endpoints.
 *
 * @package Apidaze\Rest
 */
class CdrHttpHandlers
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
    protected $endpoint = '/cdrhttphandlers';

    /**
     * Instantiates a CdrHttpHandlers client.
     *
     * @param HttpClient $http A pre-authenticated HTTP client to consume
     */
    public function __construct(HttpClient $http)
    {
        $this->http = $http;
    }

    /**
     * Shows CDR handlers list
     *
     * @return array The response
     */
    public function list()
    {
        return $this->http->request(HttpMethods::GET, $this->endpoint);
    }

    /**
     * Creates a new CDR HTTP Handler.
     * This will post the call detail (after a call) to the
     * webhook URL you define.
     *
     * @param string $url URL of your application
     * @param string $name Your App name
     *
     * @return array The response
     */
    public function create(string $url, string $name)
    {
        $payload = [
          "url" => $url,
          "name" => $name
        ];

        return $this->http->request(HttpMethods::POST, $this->endpoint, $payload);
    }

    /**
     * Updates your current CDR HTTP Handler.
     *
     * @param int $id ID of your CDR handler
     * @param string $url URL of your application
     * @param string $name Your App name
     *
     * @return array The response
     */
    public function update(int $id, string $url, string $name)
    {
        $payload = [
          "url" => $url,
          "name" => $name
        ];

        return $this->http->request(HttpMethods::PUT, $this->endpoint . '/' . strval($id), $payload);
    }
}
