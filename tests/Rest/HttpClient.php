<?php

use Apidaze\Rest\HttpClient;
use Apidaze\Rest\HttpMethods;
use Http\Mock\Client;
use PHPUnit\Framework\TestCase;

class HttpClientTest extends TestCase
{
    protected $apiKey = 'API_KEY';
    protected $apiSecret = 'API_SECRET';
    protected $apiUrl = 'https://api4.apidaze.io/';

    public function testClient()
    {
        $this->assertTrue(true);
    }

    public function testSendingRequest()
    {
        $instance = $this->createInstance();
        $response = $instance->request(HttpMethods::GET, '/sample');

        $body = $response->getBody()->getContents();
        $statusCode = $response->getStatusCode();
        $headers = $response->getHeaders();

        $this->assertSame($statusCode, 200);
        $this->assertEmpty($body);
        $this->assertIsArray($headers);
        $this->assertEmpty($headers);
    }

    public function testFailingRequestOnTooFewArguments()
    {
        $this->expectException(\ArgumentCountError::class);

        $instance = $this->createInstance();
        $instance->request();
    }

    public function createInstance()
    {
        $mockClient = new Client();
        return new HttpClient($this->apiKey, $this->apiSecret, $this->apiUrl, $mockClient);
    }
}
