<?php

namespace Apidaze\Rest;

use Apidaze\Rest\HttpClient;
use Apidaze\Rest\HttpMethods;
use Http\Message\MultipartStream\MultipartStreamBuilder;

/**
 * A client for accessing the Media Files related endpoints.
 *
 * @package Apidaze\Rest
 */
class MediaFiles
{
    /**
     * A HTTP client
     *
     * @var \Apidaze\Rest\HttpClient
     */
    protected $http;

    /**
     * The base path to the endpoint(s) for the respective client
     *
     * @var string
     */
    protected $endpoint = '/mediafiles';

    /**
     * Instantiates a MediaFiles client.
     *
     * @param HttpClient $http A pre-authenticated HTTP client to consume
     */
    public function __construct(HttpClient $http)
    {
        $this->http = $http;
    }

    /**
     * List all Mediafiles for an application.
     *
     * @param int $maxItems Max number of file listings to return. If this limit is reached
     * for a response, a List-Truncation-Token response header will
     * contain the token to use in a subsequent call with the
     * last_token property. Default 500.
     * @param bool $details Include size and modified date in response data.
     * Default false.
     * @param string $filter Response data will only include files matching exact string
     * to filter.
     * @param string $lastToken This should only be used if you are continuing
     * a partial request. Supply the value from a previous
     * request's List-Truncation-Token response header
     * to continue with partitioned data.
     *
     * @return array The response
     */
    public function list(int $maxItems = 500, bool $details = false, string $filter = "", string $lastToken = "")
    {
        $params = [
          "max_items" => $maxItems,
          "filter" => $filter,
          "last_token" => $lastToken,
        ];

        if ($details) {
            array_push($params, [ "details" => $details ]);
        }

        return $this->http->request(HttpMethods::GET, $this->endpoint, [], $params);
    }

    /**
     * Download a Mediafile.
     *
     * @param string $filename Enter the filename with any custom pathing to stat.
     *  Example: test_playback_file.wav, clients/bob/test_playback_file.wav
     *
     * @return array The response
     */
    public function get(string $filename)
    {
        return $this->http->request(HttpMethods::GET, $this->endpoint . '/' . $filename);
    }

    /**
    * Show a Mediafile summary.
    *
    * @param string $filename Enter the filename with any custom pathing to stat.
    *  Example: test_playback_file.wav, clients/bob/test_playback_file.wav
    *
    * @return array The response
    */
    public function summary(string $filename)
    {
        return $this->http->request(HttpMethods::HEAD, $this->endpoint . '/' . $filename);
    }

    /**
    * Delete a Mediafile from an application.
    *
    * @param string $filename Enter the filename with any custom pathing to stat.
    *  Example: test_playback_file.wav, clients/bob/test_playback_file.wav
    *
    * @return array The response
    */
    public function remove(string $filename)
    {
        return $this->http->request(HttpMethods::DELETE, $this->endpoint . '/' . $filename);
    }

    /**
    *  Upload a Mediafile for an application.
    *  Mediafiles can be used in playback tags by simply
    *  referencing the uploaded file name. WAV Files
    *  will be converted to 8k, 16bit, 1channel audio.
    *  For best quality and fastest processing,
    *  supply an audio file with these exact specs.
    *
    * @param string $mediale This is the file to upload.
    * @param string $name The name of the file to upload. This can include
    *  pathing test_playback_file.wav,
    *  clients/bob/test_playback_file.wav, ...
    *  If this is not supplied, the file will be saved
    *  with its original name.
    *
    * @return array The response
    */
    public function upload(string $mediafile, string $name = null)
    {
        $mediafile = fopen($mediafile, "r");

        $builder = new MultipartStreamBuilder($this->http->streamFactory);
        $builder
      ->addResource('mediafile', $mediafile, ["headers" => ["Content-Type" => "audio/wav"], "filename" => $name]);

        $payload = $builder->build();
        $boundary = $builder->getBoundary();

        $headers = ["Content-Type" => 'multipart/form-data; boundary="' . $boundary . '"'];

        return $this->http->request(HttpMethods::POST, $this->endpoint, $payload, [], $headers);
    }
}
