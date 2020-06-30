<?php

namespace Apidaze\Rest;

use Apidaze\Rest\HttpClient;
use Apidaze\Rest\HttpMethods;

/**
 * A client for accessing the ExternalScripts related endpoints.
 *
 * @package Apidaze\Rest
 */
class ExternalScripts
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
    protected $endpoint = '/externalscripts';

    /**
     * Instantiates a ExternalScripts client.
     *
     * @param HttpClient $http A pre-authenticated HTTP client to consume
     */
    public function __construct(HttpClient $http)
    {
        $this->http = $http;
    }

    /**
     * Shows external scripts list
     *
     * @return array The response
     */
    public function list()
    {
        return $this->http->request(HttpMethods::GET, $this->endpoint);
    }

    /**
     * Shows specific external script by id
     *
     * @param int $id id of external script
     *
     * @return array The response
     */
    public function get(int $id)
    {
        return $this->http->request(HttpMethods::GET, $this->endpoint . "/" . strval($id));
    }

    /**
     * Updates the external script with given id.
     *
     * @param int $id id of external script
     * @param string $url URL of your external script
     * @param string $name Name of your external script
     *
     * @return array The response
     */
    public function update(int $id, string $url, string $name)
    {
        $payload = [
        "url" => $url,
        "name" => $name
      ];

        return $this->http->request(HttpMethods::PUT, $this->endpoint . "/" . strval($id), $payload);
    }
}
