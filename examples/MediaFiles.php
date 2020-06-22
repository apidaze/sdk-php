<?php
$parentFolder = dirname(__DIR__, 1);
require $parentFolder . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable($parentFolder);
$dotenv->load();

$apiKey = getenv('API_KEY');
$apiSecret = getenv('API_SECRET');

use Apidaze\Rest\Client as Apidaze;

$apidazeClient = new Apidaze($apiKey, $apiSecret);

$response = $apidazeClient->mediaFiles->list();
$response = $apidazeClient->mediaFiles->summary("mediafile.wav");
// $filename = "mediafile.wav";
// $response = $apidazeClient->mediaFiles->get($filename);
// \file_put_contents($filename, $response['body']);

// $response = $apidazeClient->mediaFiles->remove("newFile1234.wav");
// $response = $apidazeClient->mediaFiles->upload("mediafile.wav", "newFile098");

print_r($response);
