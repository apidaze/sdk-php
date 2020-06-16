<?php

namespace Apidaze\Rest;

use Apidaze\Rest\CdrHttpHandlers;
use Apidaze\Rest\HttpClient;
use Apidaze\Rest\Messages;
use Apidaze\Rest\Misc;

/**
 * A client for accessing the Apidaze API.
 *
 * @package Apidaze\Rest
 */
class Client
{
    /**
     * a Http client
     *
     * @var \Apidaze\Rest\HttpClient
     */
    public $http;

    public $applications;
    public $messages;
    public $externalScripts;
    public $calls;
    public $cdrHttpHandlers;
    public $recordings;
    /**
     * a Miscellaneous client
     *
     * @var \Apidaze\Rest\Misc
     */
    public $misc;
    public $media;
    public $sipUsers;

    /**
     * Instantiates an Apidaze client.
     *
     * @param string $apiKey API key to authenticate with
     * @param string $apiSecret API secret to authenticate with
     * @param string $apiUrl API URL to access to
     */
    public function __construct(string $apiKey, string $apiSecret, string $apiUrl = 'https://api4.apidaze.io/')
    {
        $this->http = new HttpClient($apiKey, $apiSecret, $apiUrl);

        $this->misc = new Misc($this->http);
        $this->cdrHttpHandlers = new CdrHttpHandlers($this->http);
        $this->messages = new Messages($this->http);
    }
}