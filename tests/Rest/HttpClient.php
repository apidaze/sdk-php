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

        $this->assertSame($response['statusCode'], 200);
        $this->assertNull($response['body']);
        $this->assertIsArray($response['headers']);
        $this->assertEmpty($response['headers']);
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
