<?php

use Apidaze\Builder\Builder;
use Apidaze\Builder\Nodes\Answer;
use Apidaze\Builder\Nodes\Record;
use Apidaze\Builder\Nodes\Wait;

$parentFolder = dirname(__DIR__, 1);
require $parentFolder . '/vendor/autoload.php';

$script = new Builder();

$wait = new Wait(2);
$answer = new Answer();
$recordAttributes = [
    "aleg" => true,
    "bleg" => true,
    "on-answered" => true
];
$record = new Record($recordAttributes);

$script
    ->add($wait)
    ->add($record)
    ->add($answer);

// three ways to print the script as a string in the shape of XML
var_dump($script->asXML());
var_dump(strval($script));
var_dump((string) $script);
