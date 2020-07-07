<?php

namespace Apidaze\Rest;

use Apidaze\Rest\HttpClient;
use Apidaze\Rest\HttpMethods;

/**
 * A client for accessing the SipUsers related endpoints.
 *
 * @package Apidaze\Rest
 */
class SipUsers
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
    protected $endpoint = '/sipusers';

    /**
     * Instantiates a SipUsers client.
     *
     * @param HttpClient $http A pre-authenticated HTTP client to consume
     */
    public function __construct(HttpClient $http)
    {
        $this->http = $http;
    }

    /**
     * Shows a list of existing SIP users
     *
     * @return array The response
     */
    public function list()
    {
        return $this->http->request(HttpMethods::GET, $this->endpoint);
    }

    /**
     * Create a SIP User for devices to register to Apidaze Freeswitches
     *
     * @param string $username Username for the new SIP User.
     * @param string $name Name for the new SIP User.
     * @param string $emailAddress Email address for the Sip User.
     * @param string $internalCallerIdNumber Set as local extension
     * @param string $externalCallerIdNumber Caller id value that will be present in any call requests from the registered user.
     *
     * @return array The response
     */
    public function create(string $username, string $name, string $emailAddress, string $internalCallerIdNumber, string $externalCallerIdNumber)
    {
        $payload = [
        "username" => $username,
        "name" => $name,
        "email_address" => $emailAddress,
        "internal_caller_id_number" => $internalCallerIdNumber,
        "external_caller_id_number" => $externalCallerIdNumber
      ];

        return $this->http->request(HttpMethods::POST, $this->endpoint, $payload);
    }

    /**
     * Delete a SIP User registered to an Apidaze Freeswitch.
     *
     * @param int $id id of the user to delete
     *
     * @return array The response
     */
    public function remove(int $id)
    {
        return $this->http->request(HttpMethods::DELETE, $this->endpoint . "/" . strval($id));
    }

    /**
     * Shows the details of a single SIP User.
     *
     * @param int $id id of the user to show details
     *
     * @return array The response
     */
    public function get(int $id)
    {
        return $this->http->request(HttpMethods::GET, $this->endpoint . "/" . strval($id));
    }

    /**
     * Update a SIP User.
     *
     * @param int $id ID of the user to update
     * @param string $name Name for the new SIP User.
     * @param string $internalCallerIdNumber Set as local extension
     * @param string $externalCallerIdNumber Caller id value that will be present in any call requests from the registered user.
     * @param bool $resetPassword If true, a new password will be generated for the SIP User.
     *
     * @return array The response
     */
    public function update(int $id, string $name = "", string $internalCallerIdNumber = "", string $externalCallerIdNumber = "", bool $resetPassword = false)
    {
        $payload = [
        "name" => $name,
        "internal_caller_id_number" => $internalCallerIdNumber,
        "external_caller_id_number" => $externalCallerIdNumber
      ];

        if ($resetPassword) {
            $payload["reset_password"] = $resetPassword;
        }

        return $this->http->request(HttpMethods::PUT, $this->endpoint . "/" . strval($id), $payload);
    }

    /**
     * Show the status of a SIP User.
     *
     * @param int $id id of the user to check active registration status
     *
     * @return array The response
     */
    public function status(int $id)
    {
        return $this->http->request(HttpMethods::GET, $this->endpoint . "/" . strval($id) . "/status");
    }

    /**
     * Reset the password for a SIP User.
     *
     * @param int $id ID of the user to reset their password
     *
     * @return array The response
     */
    public function resetPassword(int $id)
    {
        return $this->http->request(HttpMethods::POST, $this->endpoint . "/" . strval($id) . "/password");
    }
}
