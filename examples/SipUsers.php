<?php
$parentFolder = dirname(__DIR__, 1);
require $parentFolder . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable($parentFolder);
$dotenv->load();

$apiKey = getenv('API_KEY');
$apiSecret = getenv('API_SECRET');

use Apidaze\Rest\Client as Apidaze;

$apidazeClient = new Apidaze($apiKey, $apiSecret);

$response = $apidazeClient->sipUsers->list();
// $response = $apidazeClient->sipUsers->create("bartosz_test", "Bartosz test user", "email@email.tld", "123", "1234567890");
// $response = $apidazeClient->sipUsers->remove(25836);
// $response = $apidazeClient->sipUsers->update(25837, "New Bartosz test user", "5345353553", "1234242313");
// $response = $apidazeClient->sipUsers->status(25840);
// $response = $apidazeClient->sipUsers->resetPassword(25837);

print_r($response->body);