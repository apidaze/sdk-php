<?php
$parentFolder = dirname(__DIR__, 1);
require $parentFolder . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable($parentFolder);
$dotenv->load();

$apiKey = getenv('API_KEY');
$apiSecret = getenv('API_SECRET');

use Apidaze\Rest\Client as Apidaze;
use Apidaze\Rest\CallType;

$apidazeClient = new Apidaze($apiKey, $apiSecret);

$response = $apidazeClient->calls->list();
$response = $apidazeClient->calls->place("14125423968", "0000", "0000", CallType::number);
// $response = $apidazeClient->calls->get("");
// $response = $apidazeClient->calls->terminate("");

print_r($response->body);