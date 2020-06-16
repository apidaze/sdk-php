<?php

namespace Apidaze\Rest;

use Apidaze\Rest\HttpMethods;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriFactoryInterface;

/**
 * An HTTP client
 *
 * @package Apidaze\Rest
 */
class HttpClient
{
    /**
     * API key to authenticate with
     *
     * @var string
     */
    protected $apiKey;
    /**
     * API secret to authenticate with
     *
     * @var string
     */
    protected $apiSecret;
    /**
     * API URL to access to
     *
     * @var string
     */
    protected $apiUrl;
    /**
     * Combination of $apiUrl and $apiKey due to the API's nature
     *
     * @var string
     */
    protected $baseUrl;

    /**
     * @var ClientInterface
     */
    private $httpClient;

    /**
     * @var RequestFactoryInterface
     */
    private $requestFactory;

    /**
     * @var ResponseFactoryInterface
     */
    private $responseFactory;

    /**
     * @var UriFactoryInterface
     */
    private $uriFactory;

    /**
     * Instantiates an HTTP client.
     *
     * @param string $apiKey API key to authenticate with
     * @param string $apiSecret API secret to authenticate with
     * @param string $apiUrl API URL to access to
     * @param ClientInterface|null $client Custom HTTP client to consume
     * @param RequestFactoryInterface|null $requestFactory Custom RequestFactory to consume
     * @param ResponseFactoryInterface|null $responseFactory Custom ResponseFactory to consume
     * @param UriFactoryInterface|null $uriFactory Custom UriFactory to consume
     * @param StreamFactoryInterface|null $streamFactory Custom StreamFactory to consume
     */
    public function __construct(
        string $apiKey,
        string $apiSecret,
        string $apiUrl,
        ClientInterface $client = null,
        RequestFactoryInterface $requestFactory = null,
        ResponseFactoryInterface $responseFactory = null,
        UriFactoryInterface $uriFactory = null,
        StreamFactoryInterface $streamFactory = null
    ) {
        $this->apiKey = $apiKey;
        $this->apiSecret = $apiSecret;
        $this->apiUrl = $apiUrl;

        $this->baseUrl = $apiUrl . $apiKey;

        $this->httpClient = $client ?: Psr18ClientDiscovery::find();
        $this->requestFactory = $requestFactory ?: Psr17FactoryDiscovery::findRequestFactory();
        $this->responseFactory = $responseFactory ?: Psr17FactoryDiscovery::findResponseFactory();
        $this->uriFactory = $uriFactory ?: Psr17FactoryDiscovery::findUrlFactory();
        $this->streamFactory = $streamFactory ?: Psr17FactoryDiscovery::findStreamFactory();
    }

    /**
     * Send an HTTP request with the given arguments
     *
     * @param string $method
     * @param string $endpoint
     * @param array $payload
     * @return ResponseInterface
     * @throws \Psr\Http\Client\ClientExceptionInterface When no client to consume for HTTP requests found
     */
    public function request(string $method, string $endpoint, array $payload = [], array $params = [])
    {
        $url = $this->baseUrl . $endpoint;
        $uri = $this->uriFactory->createUri($url);
        
        $query = [
          'api_secret' => $this->apiSecret
        ];

        if (!empty($params)) {
            $query = array_merge($query, $params);
        }

        $query = \http_build_query($query);
        $uri = $uri->withQuery($query);

        $headers = $this->getHeadersWithDefault();
        $request = $this->requestFactory->createRequest($method, $uri);

        foreach ($headers as $key => $value) {
            $request = $request->withHeader($key, $value);
        }
        
        if (!empty($payload)) {
            $encodedPayload = json_encode($payload);
            $payload = $this->streamFactory->createStream($encodedPayload);
            $request = $request->withBody($payload);
        }

        $response = $this->httpClient->sendRequest($request);
        
        return $response;
    }

    /**
     * Merges the given headers with the default ones
     *
     * @param array $headers An array of headers to merge with the default ones
     * @return array A new array of the default headers along with the given headers
     */
    private function getHeadersWithDefault(array $headers = []): array
    {
        $default = [
          "Content-Type" => "application/json",
        ];

        return array_merge($default, $headers);
    }
}
