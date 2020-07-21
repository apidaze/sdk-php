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

$assignedDID = "14125423968";
$myNumber = "00000‬";

// $response = $apidazeClient->calls->list();
$response = $apidazeClient->calls->place($assignedDID, $myNumber, $myNumber, CallType::number);
// $response = $apidazeClient->calls->get("");
// $response = $apidazeClient->calls->terminate("");

print_r($response->body);