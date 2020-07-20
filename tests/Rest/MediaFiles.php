<?php

use Apidaze\Rest\HttpClient;
use Apidaze\Rest\MediaFiles;
use Http\Mock\Client;
use PHPUnit\Framework\TestCase;

class MediaFilesTest extends TestCase
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
        "file.wav", "newFile.wav", "test.wav"
        ]];
        $encodedBody = json_encode($body);

        $statusCode = 200;
        $headers = [];
        $mockResponse = $this->createResponse($encodedBody, $statusCode, $headers);
        $this->mockHttpClient->addResponse($mockResponse);

        $response = $instance->list();

        $this->assertSame($response->statusCode, $statusCode);
        $this->assertSame($response->body, $body);
        $this->assertSame($response->headers, $headers);
    }

    public function testGet()
    {
        $instance = $this->createInstances();

        $body = "some binary data";
        $statusCode = 200;
        $headers = [];
        $mockResponse = $this->createResponse($body, $statusCode, $headers);
        $this->mockHttpClient->addResponse($mockResponse);

        $response = $instance->get("my_mediaFile.wav");

        $this->assertSame($response->statusCode, $statusCode);
        $this->assertEquals($response->streamBody, $body);
        $this->assertSame($response->headers, $headers);
    }

    public function testSummary()
    {
        $instance = $this->createInstances();

        $body = [];
        $encodedBody = json_encode($body);

        $statusCode = 200;
        $headers = [];
        $mockResponse = $this->createResponse($encodedBody, $statusCode, $headers);
        $this->mockHttpClient->addResponse($mockResponse);

        $response = $instance->summary("my_mediaFile.wav");

        $this->assertSame($response->statusCode, $statusCode);
        $this->assertSame($response->body, $body);
        $this->assertSame($response->headers, $headers);
    }

    public function testRemove()
    {
        $instance = $this->createInstances();

        $body = [];
        $encodedBody = json_encode($body);

        $statusCode = 204;
        $headers = [];
        $mockResponse = $this->createResponse($encodedBody, $statusCode, $headers);
        $this->mockHttpClient->addResponse($mockResponse);

        $response = $instance->remove("my_mediaFile.wav");

        $this->assertSame($response->statusCode, $statusCode);
        $this->assertEquals($response->body, $body);
        $this->assertSame($response->headers, $headers);
    }

    public function testUpload()
    {
        $name = "myNewFilename";
        $instance = $this->createInstances();

        $body = [ "body" => "Ok, file saved as " . $name];
        $encodedBody = json_encode($body);

        $statusCode = 200;
        $headers = [];
        $mockResponse = $this->createResponse($encodedBody, $statusCode, $headers);
        $this->mockHttpClient->addResponse($mockResponse);

        $response = $instance->upload("resources/apidazeintro.wav", $name);

        $this->assertSame($response->statusCode, $statusCode);
        $this->assertEquals($response->body, $body);
        $this->assertSame($response->headers, $headers);
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
        return new MediaFiles($httpClient);
    }
}
