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
// $response = $apidazeClient->recordings->list();

// 2
$filename = "example_recording.wav";
$response = $apidazeClient->recordings->get($filename);
\file_put_contents($filename, $response['body']);

// print_r($response);