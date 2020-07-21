<?php

use Apidaze\Builder\Builder;
use Apidaze\Builder\Nodes\Answer;
use Apidaze\Builder\Nodes\Record;
use Apidaze\Builder\Nodes\Wait;
use Apidaze\Builder\Nodes\Bind;
use Apidaze\Builder\Nodes\Conference;
use Apidaze\Builder\Nodes\Dial;
use Apidaze\Builder\Nodes\DialTargetType;
use Apidaze\Builder\Nodes\Number;
use Apidaze\Builder\Nodes\SipAccount;
use Apidaze\Builder\Nodes\SipUri;

$parentFolder = dirname(__DIR__, 1);
require $parentFolder . '/vendor/autoload.php';

$script = new Builder();

$wait = new Wait(2);
$answer = new Answer();
$record = new Record();
$bind = new Bind("1", "https://my.script.ltd");
$conference = new Conference("my_room");
$number = new Number("789789686");
$sipuri = new SipUri("sipuri");
$sipaccount = new SipAccount("me@sip.tld");
$dial = new Dial("1231311131", DialTargetType::number);
$dial->add($number)
    ->add($sipaccount)
    ->add($sipuri);

$script
    ->add($wait)
    ->add($record)
    ->add($answer)
    ->add($bind)
    ->add($conference)
    ->add($dial);

// three ways to print the script as a string in the shape of XML
var_dump($script->asXML());
// var_dump(strval($script));
// var_dump((string) $script);