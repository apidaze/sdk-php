<?php

use Apidaze\Rest\HttpClient;
use Apidaze\Rest\Messages;
use Http\Mock\Client;
use PHPUnit\Framework\TestCase;

class MessagesTest extends TestCase
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

    public function testSendSMS()
    {
        $instance = $this->createInstances();

        $body = [ "status" => [ "message" => "Message sent" ]];
        $statusCode = 200;
        $headers = [];
        $mockResponse = $this->createResponse($body, $statusCode, $headers);
        $this->mockHttpClient->addResponse($mockResponse);

        $response = $instance->send("from", "to", "message");

        $this->assertSame($response['statusCode'], $statusCode);
        $this->assertSame($response['body'], $body);
        $this->assertSame($response['headers'], $headers);
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
        return new Messages($httpClient);
    }
}
