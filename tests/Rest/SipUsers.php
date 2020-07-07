<?php

use Apidaze\Rest\HttpClient;
use Apidaze\Rest\SipUsers;
use Http\Mock\Client;
use PHPUnit\Framework\TestCase;

class SipUsersTest extends TestCase
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
          "internal" => "123",
          "outbound" => "456"
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
          "internal" => "123",
          "outbound" => "456"
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

    public function testCreate()
    {
        $instance = $this->createInstances();

        $id = 1900;
        $name = "my name";
        $internal = "1235342523";
        $outbound = "6456462342";
        $username = "testUser";
        $email = "email@email.tld";

        $body = [ "body" => [
          "id" => $id,
          "name" => $name,
          "internal" => $internal,
          "outbound" => $outbound,
          "email" => $email
          ]];
        $statusCode = 200;
        $headers = [];
        $mockResponse = $this->createResponse($body, $statusCode, $headers);
        $this->mockHttpClient->addResponse($mockResponse);

        $response = $instance->create($username, $name, $email, $internal, $outbound);

        $this->assertSame($response->statusCode, $statusCode);
        $this->assertSame($response->body, $body);
        $this->assertSame($response->headers, $headers);
    }

    public function testUpdate()
    {
        $instance = $this->createInstances();

        $id = 1900;
        $name = "my name";
        $internal = "1235342523";

        $body = [ "body" => [
          "id" => $id,
          "name" => $name,
          "internal" => $internal
          ]];
        $statusCode = 200;
        $headers = [];
        $mockResponse = $this->createResponse($body, $statusCode, $headers);
        $this->mockHttpClient->addResponse($mockResponse);

        $response = $instance->update($id, $name, $internal);

        $this->assertSame($response->statusCode, $statusCode);
        $this->assertSame($response->body, $body);
        $this->assertSame($response->headers, $headers);
    }

    public function testStatus()
    {
        $instance = $this->createInstances();

        $body = [ "body" => [
          "uri" => "sip:test_user@voip.addr",
          "status" => "Not registered"
          ]];
        $statusCode = 200;
        $headers = [];
        $mockResponse = $this->createResponse($body, $statusCode, $headers);
        $this->mockHttpClient->addResponse($mockResponse);

        $response = $instance->status(1900);

        $this->assertSame($response->statusCode, $statusCode);
        $this->assertSame($response->body, $body);
        $this->assertSame($response->headers, $headers);
    }

    public function testRemove()
    {
        $instance = $this->createInstances();

        $body = [];
        $statusCode = 204;
        $headers = [];
        $mockResponse = $this->createResponse($body, $statusCode, $headers);
        $this->mockHttpClient->addResponse($mockResponse);

        $response = $instance->remove(1900);

        $this->assertSame($response->statusCode, $statusCode);
        $this->assertSame($response->body, $body);
        $this->assertSame($response->headers, $headers);
    }

    public function testResetPassword()
    {
        $instance = $this->createInstances();

        $body = [ "body" => [
          "username" => "testUser",
          "password" => "'laf;m4p5223nsdfHJ"
          ]];

        $statusCode = 200;
        $headers = [];
        $mockResponse = $this->createResponse($body, $statusCode, $headers);
        $this->mockHttpClient->addResponse($mockResponse);

        $response = $instance->resetPassword(1900);

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
        return new SipUsers($httpClient);
    }
}
