<?php

namespace Apidaze\Rest;

use Apidaze\Rest\Calls;
use Apidaze\Rest\CdrHttpHandlers;
use Apidaze\Rest\ExternalScripts;
use Apidaze\Rest\HttpClient;
use Apidaze\Rest\MediaFiles;
use Apidaze\Rest\Messages;
use Apidaze\Rest\Misc;
use Apidaze\Rest\Recordings;
use Apidaze\Rest\SipUsers;

/**
 * A client for accessing the Apidaze API.
 *
 * @package Apidaze\Rest
 */
class Client
{
    /**
     * The Http client
     *
     * @var \Apidaze\Rest\HttpClient
     */
    public $http;

    /**
     * The Applications client
     *
     * @var \Apidaze\Rest\Applications
     */
    public $applications;

    /**
     * The Messages client
     *
     * @var \Apidaze\Rest\Messages
     */
    public $messages;

    /**
     * The ExternalScripts client
     *
     * @var \Apidaze\Rest\ExternalScripts
     */
    public $externalScripts;

    /**
     * The Calls client
     *
     * @var \Apidaze\Rest\Calls
     */
    public $calls;

    /**
     * The CdrHttpHandlers client
     *
     * @var \Apidaze\Rest\CdrHttpHandlers
     */
    public $cdrHttpHandlers;

    /**
     * The Recordings client
     *
     * @var \Apidaze\Rest\Recordings
     */
    public $recordings;

    /**
     * The Miscellaneous client
     *
     * @var \Apidaze\Rest\Misc
     */
    public $misc;

    /**
     * The MediaFiles client
     *
     * @var \Apidaze\Rest\MediaFiles
     */
    public $mediaFiles;

    /**
     * The SipUsers client
     *
     * @var \Apidaze\Rest\SipUsers
     */
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
        $this->recordings = new Recordings($this->http);
        $this->externalScripts = new ExternalScripts($this->http);
        $this->mediaFiles = new MediaFiles($this->http);
        $this->sipUsers = new SipUsers($this->http);
        $this->applications = new Applications($this->http);
        $this->calls = new Calls($this->http);
    }

    /**
     * Returns the Apidaze Client class based on the application id.
     *
     * @param int $appId Id of the sub-application
     *
     * @return Client Apidaze Client object
     */

    public function getClientByAppId(int $appId): Client
    {
        $appData = $this->applications->getByAppId($appId);
        return $this->__getClientForAppData($appData->body[0]);
    }

    /**
     * Returns the Apidaze Client class based on the api key.
     *
     * @param string $apiKey Api key of the sub-application
     *
     * @return Client Apidaze Client object
     */

    public function getClientByApiKey(string $apiKey): Client
    {
        $appData = $this->applications->getByApiKey($apiKey);
        return $this->__getClientForAppData($appData->body[0]);
    }

    /**
     * Returns the Apidaze Client class based on the application name.
     *
     * @param string $name Name of the sub-application
     *
     * @return Client Apidaze Client object
     */

    public function getClientByName(string $name): Client
    {
        $appData = $this->applications->getByName($name);
        return $this->__getClientForAppData($appData->body[0]);
    }

    private function __getClientForAppData(array $appData)
    {
        $apiKey = $appData["api_key"];
        $apiSecret = $appData["api_secret"];

        if (empty($apiKey) || empty($apiSecret)) {
            throw new Exception('Api Key or Api Secret are not present in the app data');
        }

        return new Client($apiKey, $apiSecret);
    }
}
