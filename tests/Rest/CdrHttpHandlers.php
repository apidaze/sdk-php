<?php

use Apidaze\Rest\CdrHttpHandlers;
use Apidaze\Rest\HttpClient;
use Http\Mock\Client;
use PHPUnit\Framework\TestCase;

class CdrHttpHandlersTest extends TestCase
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
        "id" => 120,
        "name" => "New Name",
        "format" => "regular",
        "url" => "http://example.tld",
        "call_leg" => "inbound",
        "created_at" => "2020-03-17T12:31:57.000Z",
        "updated_at" => "2020-06-04T10:13:49.000Z"
        ]];
        $statusCode = 200;
        $headers = [];
        $mockResponse = $this->createResponse($body, $statusCode, $headers);
        $this->mockHttpClient->addResponse($mockResponse);

        $response = $instance->list();

        $this->assertSame($response->statusCode, $statusCode);
        $this->assertSame($response->body, $body);
        $this->assertSame($response->headers, $headers);
    }

    public function testCreate()
    {
        $instance = $this->createInstances();

        $body = [ "status" => [
          "id" => 120,
          "name" => "New Name",
          "format" => "regular",
          "url" => "http://example.tld",
          "call_leg" => "inbound",
          "created_at" => "2020-03-17T12:31:57.000Z",
          "updated_at" => "2020-06-04T10:13:49.000Z"
          ]];
        $statusCode = 200;
        $headers = [];
        $mockResponse = $this->createResponse($body, $statusCode, $headers);
        $this->mockHttpClient->addResponse($mockResponse);

        $response = $instance->create("http://exmaple.com/cdr-handler", "CDR Handler");

        $this->assertSame($response->statusCode, $statusCode);
        $this->assertSame($response->body, $body);
        $this->assertSame($response->headers, $headers);
    }

    public function testUpdate()
    {
        $instance = $this->createInstances();

        $body = [ "status" => [
          "id" => 120,
          "name" => "New Name",
          "format" => "regular",
          "url" => "http://example.tld",
          "call_leg" => "inbound",
          "created_at" => "2020-03-17T12:31:57.000Z",
          "updated_at" => "2020-06-04T10:13:49.000Z"
          ]];
        $statusCode = 200;
        $headers = [];
        $mockResponse = $this->createResponse($body, $statusCode, $headers);
        $this->mockHttpClient->addResponse($mockResponse);

        $response = $instance->update(101, "http://exmaple.com/cdr-handler", "CDR Handler");

        $this->assertSame($response->statusCode, $statusCode);
        $this->assertSame($response->body, $body);
        $this->assertSame($response->headers, $headers);
    }



    public function createResponse(array $body = null, int $statusCode = null, array $headers = [])
    {
        $encodedBody = json_encode($body);
        $response = $this->createMock('Psr\Http\Message\ResponseInterface');
        $response->method('getBody')->willReturn($encodedBody);
        $response->method('getStatusCode')->willReturn($statusCode);
        $response->method('getHeaders')->willReturn($headers);

        return $response;
    }

    public function createInstances()
    {
        $httpClient = new HttpClient($this->apiKey, $this->apiSecret, $this->apiUrl, $this->mockHttpClient);
        return new CdrHttpHandlers($httpClient);
    }
}
