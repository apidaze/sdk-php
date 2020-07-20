<?php
$parentFolder = dirname(__DIR__, 1);
require $parentFolder . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable($parentFolder);
$dotenv->load();

$apiKey = getenv('API_KEY');
$apiSecret = getenv('API_SECRET');

use Apidaze\Rest\Client as Apidaze;

$apidazeClient = new Apidaze($apiKey, $apiSecret);

// $response = $apidazeClient->applications->list();
// $response = $apidazeClient->applications->getByAppId(3050);
// $response = $apidazeClient->applications->getByApiKey("k2reiyjx");
// $response = $apidazeClient->applications->getByName("APPLICATION 69");

// $client = $apidazeClient->getClientByAppId(3164);
// $client = $apidazeClient->getClientByApiKey("k2reiyjx");
$client = $apidazeClient->getClientByName("APPLICATION 69");

$response = $client->applications->list();

print_r($response->body);
// print_r($client);