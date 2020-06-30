<?php
$parentFolder = dirname(__DIR__, 1);
require $parentFolder . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable($parentFolder);
$dotenv->load();

$apiKey = getenv('API_KEY');
$apiSecret = getenv('API_SECRET');

use Apidaze\Rest\Client as Apidaze;

$apidazeClient = new Apidaze($apiKey, $apiSecret);

$response = $apidazeClient->externalScripts->list();
// $response = $apidazeClient->externalScripts->get(1839);
// $response = $apidazeClient->externalScripts->update(1839, "https://test.test", "New script 2");

print_r($response);
