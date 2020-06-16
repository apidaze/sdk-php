<?php

use Apidaze\Rest\Client as Apidaze;
use Apidaze\Rest\HttpClient;
use Apidaze\Rest\Misc;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    protected $apiKey = 'API_KEY';
    protected $apiSecret = 'API_SECRET';
    protected $apiUrl = 'https://api4.apidaze.io/';

    public function testClients()
    {
        $client = new Apidaze($this->apiKey, $this->apiSecret);
        $subClientNames = [
            'http' => HttpClient::class,
            'misc' => Misc::class
        ];

        foreach ($subClientNames as $subClientName => $subClientClassName) {
            $subClient = $client->$subClientName;

            $this->assertTrue($subClient instanceof $subClientClassName);
        }
    }
}
