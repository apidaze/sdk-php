<?php

use Apidaze\Rest\Applications;
use Apidaze\Rest\HttpClient;
use Http\Mock\Client;
use PHPUnit\Framework\TestCase;

class ApplicationsTest extends TestCase
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

        $body = [ "body" => [
          "id" => 1900,
          "name" => "my name",
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

    public function testGetByAppId()
    {
        $instance = $this->createInstances();

        $id = 1900;

        $body = [ "body" => [
          "id" => $id,
          "name" => "my name",
          ]];
        $statusCode = 200;
        $headers = [];
        $mockResponse = $this->createResponse($body, $statusCode, $headers);
        $this->mockHttpClient->addResponse($mockResponse);

        $response = $instance->getByAppId($id);

        $this->assertSame($response->statusCode, $statusCode);
        $this->assertSame($response->body, $body);
        $this->assertSame($response->headers, $headers);
    }

    public function testGetByApiKey()
    {
        $instance = $this->createInstances();

        $key = "sdfsfsfsf";

        $body = [ "body" => [
          "id" => 1900,
          "name" => "my name",
          "api_Key" => $key
          ]];
        $statusCode = 200;
        $headers = [];
        $mockResponse = $this->createResponse($body, $statusCode, $headers);
        $this->mockHttpClient->addResponse($mockResponse);

        $response = $instance->getByApiKey($key);

        $this->assertSame($response->statusCode, $statusCode);
        $this->assertSame($response->body, $body);
        $this->assertSame($response->headers, $headers);
    }

    public function testGetByName()
    {
        $instance = $this->createInstances();

        $name = "my_app";

        $body = [ "body" => [
          "id" => 1900,
          "name" => $name,
          ]];
        $statusCode = 200;
        $headers = [];
        $mockResponse = $this->createResponse($body, $statusCode, $headers);
        $this->mockHttpClient->addResponse($mockResponse);

        $response = $instance->getByName($name);

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
        return new Applications($httpClient);
    }
}
