<?php

use Apidaze\Builder\Builder;
use Apidaze\Builder\Nodes\Answer;
use Apidaze\Builder\Nodes\Record;
use Apidaze\Builder\Nodes\Wait;
use Apidaze\Builder\Nodes\Bind;
use Apidaze\Builder\Nodes\Conference;
use Apidaze\Builder\Nodes\Number;
use Apidaze\Builder\Nodes\Speak;
use Apidaze\Builder\Nodes\Ringback;
use Apidaze\Builder\Nodes\Playback;
use Apidaze\Builder\Nodes\EchoNode;

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

function intro(string $localUrl) {
  $script = new Builder();
  $ringback = new Ringback($localUrl."/apidazeintro.wav");
  $wait8 = new Wait(8);
  $answer = new Answer();
  $record = new Record("example_recording");
  $wait = new Wait(2);
  $playback = new Playback($localUrl."/apidazeintro.wav");
  $speak = new Speak("This example script will show you some things you can do with our API");

  $script->add($ringback)
        ->add($wait)
        ->add($answer)
        ->add($record)
        ->add($wait)
        ->add($playback)
        ->add($speak)
        ->add($wait);

  $speak = new Speak("Press 1 for an example of text to speech, press 2 to enter an echo line to check voice latency or press 3 to enter a conference.", "en-US", 10000);
  $bind1 = new Bind("1", $localUrl."/step1");
  $bind2 = new Bind("2", $localUrl."/step2");
  $bind3 = new Bind("3", $localUrl."/step3");
  $speak->add($bind1)
        ->add($bind2)
        ->add($bind3);

  $script->add($speak);
  return $script->asXML();
}

function step1() {
  $script = new Builder();
  $speak = new Speak("Our text to speech leverages Google's cloud APIs to offer the best possible solution");
  $wait1 = new Wait(1);

  $script->add($speak)->add($wait1);

  $speak = new Speak("A wide variety of voices and languages are available.  Here are just a few", "en-AU");
  $script->add($speak)->add($wait1);

  $speak = new Speak("Je peux parler français", "fr-FR");
  $script->add($speak)->add($wait1);

  $speak = new Speak("Auch deutsch", "de-DE");
  $script->add($speak)->add($wait1);

  $speak = new Speak("そして日本人ですら", "ja-JP");
  $script->add($speak)->add($wait1);

  $speak = new Speak("You can see our documentation for a full list of supported languages and voices for them.  We'll take you back to the menu for now.");
  $wait2 = new Wait(2);
  $script->add($speak)->add($wait2);

  return $script->asXML();
}

function step2() {
  $script = new Builder();
  $speak = new Speak("You will now be joined to an echo line.");
  $echoNode = new EchoNode(500);
  $script->add($speak)->add($echoNode);
  
  return $script->asXML();
}

function step3() {
  $script = new Builder();
  $speak = new Speak("You will be entered into a conference call now.  You can initiate more calls to join participants or hangup to leave");
  $conference = new Conference("SDKTestConference");
  $script->add($speak)->add($conference);
  
  return $script->asXML();
}

function serverWav() {
  $file = file_get_contents("resources/apidazeintro.wav");
  return $file;
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
    return new Response(Status::OK, ['content-type' => 'text/xml'], intro("http://30e3b3153506.ngrok.io"));
  }));
  $router->addRoute('GET', '/apidazeintro.wav', new CallableRequestHandler(function () {
    $size = filesize("resources/apidazeintro.wav");
    return new Response(Status::OK, ['content-type' => 'audio/wav', 'content-lenght' => $size], serverWav());
  }));
  $router->addRoute('HEAD', '/apidazeintro.wav', new CallableRequestHandler(function () {
    $size = filesize("resources/apidazeintro.wav");
    return new Response(Status::OK, ['content-type' => 'audio/wav', 'content-lenght' => $size], serverWav());
  }));
  $router->addRoute('GET', '/step1', new CallableRequestHandler(function () {
    return new Response(Status::OK, ['content-type' => 'text/xml'], step1());
  }));
  $router->addRoute('GET', '/step2', new CallableRequestHandler(function () {
    return new Response(Status::OK, ['content-type' => 'text/xml'], step2());
  }));
  $router->addRoute('GET', '/step3', new CallableRequestHandler(function () {
    return new Response(Status::OK, ['content-type' => 'text/xml'], step3());
  }));

  $server = new Server($servers, $router, $logger);
  yield $server->start();
});

