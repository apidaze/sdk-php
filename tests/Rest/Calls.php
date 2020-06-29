<?php

use Apidaze\Rest\Calls;
use Apidaze\Rest\CallType;
use Apidaze\Rest\HttpClient;
use Http\Mock\Client;
use PHPUnit\Framework\TestCase;

class CallsTest extends TestCase
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
          'uuid' => '00000000-0000-0000-0000-000000000000',
          'created' => '2019-11-22 11:30:03',
          'cid_name' => 'Outbound Call'
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

    public function testPlace()
    {
        $instance = $this->createInstances();

        $callerId = "123456789";
        $origin = "987654321";
        $destination = "987654321";

        $body = [ "body" => [
          'callerid' => $callerId,
          'origin' => $origin,
          'destination' => $destination
          ]];
        $statusCode = 200;
        $headers = [];
        $mockResponse = $this->createResponse($body, $statusCode, $headers);
        $this->mockHttpClient->addResponse($mockResponse);

        $response = $instance->place($callerId, $origin, $destination, CallType::number);

        $this->assertSame($response->statusCode, $statusCode);
        $this->assertSame($response->body, $body);
        $this->assertSame($response->headers, $headers);
    }

    public function testGet()
    {
        $instance = $this->createInstances();

        $uuid = "00000000-0000-0000-0000-000000000000";

        $body = [ "body" => [
          'uuid' => $uuid,
          'created' => '2019-11-22 11:30:03',
          'cid_name' => 'Outbound Call'
          ]];
        $statusCode = 200;
        $headers = [];
        $mockResponse = $this->createResponse($body, $statusCode, $headers);
        $this->mockHttpClient->addResponse($mockResponse);

        $response = $instance->get($uuid);

        $this->assertSame($response->statusCode, $statusCode);
        $this->assertSame($response->body, $body);
        $this->assertSame($response->headers, $headers);
    }

    public function testTerminate()
    {
        $instance = $this->createInstances();

        $uuid = "00000000-0000-0000-0000-000000000000";

        $body = [ "body" => [
          'ok' => ""
          ]];
        $statusCode = 200;
        $headers = [];
        $mockResponse = $this->createResponse($body, $statusCode, $headers);
        $this->mockHttpClient->addResponse($mockResponse);

        $response = $instance->terminate($uuid);

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
        return new Calls($httpClient);
    }
}
