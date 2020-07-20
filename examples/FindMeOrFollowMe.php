<?php

use Apidaze\Builder\Builder;
use Apidaze\Builder\Nodes\Dial;
use Apidaze\Builder\Nodes\DialStrategy;
use Apidaze\Builder\Nodes\DialTargetType;
use Apidaze\Builder\Nodes\Number;
use Apidaze\Builder\Nodes\Hangup;

$parentFolder = dirname(__DIR__, 1);
require $parentFolder . '/vendor/autoload.php';

use Amp\ByteStream\ResourceOutputStream;
use Amp\Http\Server\Request;
use Amp\Http\Server\RequestHandler\CallableRequestHandler;
use Amp\Http\Server\Response;
use Amp\Http\Server\Router;
use Amp\Http\Server\Server;
use Amp\Http\Status;
use Amp\Log\ConsoleFormatter;
use Amp\Log\StreamHandler;
use Amp\Socket;
use Monolog\Logger;

function intro(string $number1, string $number2) {
  $script = new Builder();
  $dial = new Dial($number1, DialTargetType::number, 24, null, DialStrategy::sequence, null, null, null, 12);
  $number = new Number($number2, 12);
  $hangup = new Hangup();
  $dial->add($number);

  $script->add($dial)->add($hangup);
  
  return $script->asXML();
}

Amp\Loop::run(function () {
  $servers = [
    Socket\listen("0.0.0.0:80"),
  ];

  $logHandler = new StreamHandler(new ResourceOutputStream(\STDOUT));
  $logHandler->setFormatter(new ConsoleFormatter);
  $logger = new Logger('server');
  $logger->pushHandler($logHandler);

  $router = new Router;
  $router->addRoute('GET', '/?', new CallableRequestHandler(function () {
    $first = "213131";
    $second = "234234242";
  
    return new Response(Status::OK, ['content-type' => 'text/xml'], intro($first, $second));
  }));

  $server = new Server($servers, $router, $logger);
  yield $server->start();
});

