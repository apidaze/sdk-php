<?php
$parentFolder = dirname(__DIR__, 1);
require $parentFolder . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable($parentFolder);
$dotenv->load();

$apiKey = getenv('API_KEY');
$apiSecret = getenv('API_SECRET');

use Apidaze\Rest\Client as Apidaze;

$apidazeClient = new Apidaze($apiKey, $apiSecret);

$response = $apidazeClient->cdrHttpHandlers->list();
// $response = $apidazeClient->cdrHttpHandlers->create("http://somenew.tld", "New Name");
// $response = $apidazeClient->cdrHttpHandlers->update(120, "http://somenew.tld", "New Name");

var_dump($response);
