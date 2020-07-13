<?php

namespace Apidaze\Rest;

use Apidaze\Rest\HttpClient;
use Apidaze\Rest\HttpMethods;

/**
 * A client for accessing the Applications related endpoints.
 *
 * @package Apidaze\Rest
 */
class Applications
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
    protected $endpoint = '/applications';

    /**
     * Instantiates a Applications client.
     *
     * @param HttpClient $http A pre-authenticated HTTP client to consume
     */
    public function __construct(HttpClient $http)
    {
        $this->http = $http;
    }

    /**
     * Shows sub-applications list
     *
     * @return array The response
     */
    public function list()
    {
        return $this->http->request(HttpMethods::GET, $this->endpoint);
    }

    /**
     * Shows application with id
     *
     * @param int $appId Id of the sub-application
     *
     * @return array The response
     */
    public function getByAppId(int $appId)
    {
        $params = [
        "app_id" => $appId
        ];

        return $this->http->request(HttpMethods::GET, $this->endpoint, [], $params);
    }
    
    /**
     * Shows application with api_key
     *
     * @param string $apiKey Api key of the sub-application
     *
     * @return array The response
     */
    public function getByApiKey(string $apiKey)
    {
        $params = [
        "api_key" => $apiKey
        ];

        return $this->http->request(HttpMethods::GET, $this->endpoint, [], $params);
    }
    
    /**
     * Shows application with name
     *
     * @param string $name Name of the sub-application
     *
     * @return array The response
     */
    public function getByName(string $name)
    {
        $params = [
        "app_name" => $name
        ];

        return $this->http->request(HttpMethods::GET, $this->endpoint, [], $params);
    }
}
