<?php
$parentFolder = dirname(__DIR__, 1);
require $parentFolder . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable($parentFolder);
$dotenv->load();

$apiKey = getenv('API_KEY');
$apiSecret = getenv('API_SECRET');

use Apidaze\Rest\Client as Apidaze;

$apidazeClient = new Apidaze($apiKey, $apiSecret);


// 1
$response = $apidazeClient->mediaFiles->list();

// 2
// $response = $apidazeClient->mediaFiles->summary("mediafile.wav");

// 3
// $filename = "apidazeintro.wav";
// $response = $apidazeClient->mediaFiles->get($filename);
// \file_put_contents($filename, $response->streamBody);

// 4
// $response = $apidazeClient->mediaFiles->remove("mediafile.wav");

// 5
// $response = $apidazeClient->mediaFiles->upload("mediafile.wav", "newFile123131");

print_r($response);
