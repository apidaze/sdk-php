<?php

use Apidaze\Rest\ExternalScripts;
use Apidaze\Rest\HttpClient;
use Http\Mock\Client;
use PHPUnit\Framework\TestCase;

class ExternalScriptsTest extends TestCase
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
          "url" => "https://myurl.tld"
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

    public function testGet()
    {
        $instance = $this->createInstances();

        $id = 1900;

        $body = [ "body" => [
          "id" => $id,
          "name" => "my name",
          "url" => "https://myurl.tld"
          ]];
        $statusCode = 200;
        $headers = [];
        $mockResponse = $this->createResponse($body, $statusCode, $headers);
        $this->mockHttpClient->addResponse($mockResponse);

        $response = $instance->get($id);

        $this->assertSame($response->statusCode, $statusCode);
        $this->assertSame($response->body, $body);
        $this->assertSame($response->headers, $headers);
    }

    public function testUpdate()
    {
        $instance = $this->createInstances();

        $id = 1900;
        $name = "my name";
        $url = "https://myurl.tld";

        $body = [ "body" => [
          "id" => $id,
          "name" => $name,
          "url" => $url
          ]];
        $statusCode = 200;
        $headers = [];
        $mockResponse = $this->createResponse($body, $statusCode, $headers);
        $this->mockHttpClient->addResponse($mockResponse);

        $response = $instance->update($id, $url, $name);

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
        return new ExternalScripts($httpClient);
    }
}
