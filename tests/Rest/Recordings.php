<?php

use Apidaze\Rest\HttpClient;
use Apidaze\Rest\Recordings;
use Http\Mock\Client;
use PHPUnit\Framework\TestCase;

class RecordingsTest extends TestCase
{
    protected $apiKey = 'API_KEY';
    protected $apiSecret = 'API_SECRET';
    protected $apiUrl = 'API_URL';

    protected $mockHttpClient;

    protected function setUp(): void
    {
        $this->mockHttpClient = new Client();
    }

    protected function tearDown(): void
    {
        $this->mockHttpClient->reset();
    }

    public function testList()
    {
        $instance = $this->createInstances();

        $body = [ "status" => [
        "test1", "test2", "test3"
        ]];
        $encodedBody = json_encode($body);

        $statusCode = 200;
        $headers = [];
        $mockResponse = $this->createResponse($encodedBody, $statusCode, $headers);
        $this->mockHttpClient->addResponse($mockResponse);

        $response = $instance->list();

        $this->assertSame($response['statusCode'], $statusCode);
        $this->assertSame($response['body'], $body);
        $this->assertSame($response['headers'], $headers);
    }

    public function testGet()
    {
        $instance = $this->createInstances();

        $body = "some binary data";
        $statusCode = 200;
        $headers = [];
        $mockResponse = $this->createResponse($body, $statusCode, $headers);
        $this->mockHttpClient->addResponse($mockResponse);

        $response = $instance->get("my_recording.wav");

        $this->assertSame($response['statusCode'], $statusCode);
        $this->assertEquals($response['body'], $body);
        $this->assertSame($response['headers'], $headers);
    }

    public function testRemove()
    {
        $instance = $this->createInstances();

        $body = [ "status" => "OK" ];
        $encodedBody = json_encode($body);

        $statusCode = 200;
        $headers = [];
        $mockResponse = $this->createResponse($encodedBody, $statusCode, $headers);
        $this->mockHttpClient->addResponse($mockResponse);

        $response = $instance->remove("my_recording.wav");

        $this->assertSame($response['statusCode'], $statusCode);
        $this->assertSame($response['body'], $body);
        $this->assertSame($response['headers'], $headers);
    }

    public function createResponse($body, int $statusCode = null, array $headers = [])
    {
        $response = $this->createMock('Psr\Http\Message\ResponseInterface');
        $response->method('getBody')->willReturn($body);
        $response->method('getStatusCode')->willReturn($statusCode);
        $response->method('getHeaders')->willReturn($headers);

        return $response;
    }

    public function createInstances()
    {
        $httpClient = new HttpClient($this->apiKey, $this->apiSecret, $this->apiUrl, $this->mockHttpClient);
        return new Recordings($httpClient);
    }
}
