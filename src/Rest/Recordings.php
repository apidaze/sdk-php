<?php

namespace Apidaze\Rest;

use Apidaze\Rest\HttpClient;
use Apidaze\Rest\HttpMethods;

/**
 * A client for accessing the Recordings related endpoints.
 *
 * @package Apidaze\Rest
 */
class Recordings
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
    protected $endpoint = '/recordings';

    /**
     * Instantiates a Recordings client.
     *
     * @param HttpClient $http A pre-authenticated HTTP client to consume
     */
    public function __construct(HttpClient $http)
    {
        $this->http = $http;
    }

    /**
     * Shows recordings list
     *
     * @return array The response
     */
    public function list()
    {
        $response = $this->http->request(HttpMethods::GET, $this->endpoint);
        $body = json_decode($response->getBody(), true);

        return [
        "body" => $body,
        "statusCode" => $response->getStatusCode(),
        "headers" => $response->getHeaders()
      ];
    }

    /**
     * Gets raw WAVE data for a recording by filename
     *
     * @param string $filename Name of the recordings file.
     * @param string $description Description of your download.
     *
     * @return array The response
     */
    public function get(string $filename, string $description = "")
    {
        $params = [
        "name" => $filename,
        "description" => $description
      ];

        $response = $this->http->request(HttpMethods::GET, $this->endpoint . "/" . $filename, [], $params);

        return [
        "body" => $response->getBody(),
        "statusCode" => $response->getStatusCode(),
        "headers" => $response->getHeaders()
      ];
    }

    /**
     * Removes a recording by filename
     *
     * @param string $filename Name of the recordings file.
     *
     * @return array The response
     */
    public function remove(string $filename)
    {
        $params = [
        "name" => $filename,
      ];

        $response = $this->http->request(HttpMethods::DELETE, $this->endpoint . "/" . $filename, [], $params);
        $body = json_decode($response->getBody(), true);

        return [
        "body" => $body,
        "statusCode" => $response->getStatusCode(),
        "headers" => $response->getHeaders()
      ];
    }
}
