![PHP CI](https://github.com/apidaze/sdk-php/workflows/PHP%20CI/badge.svg?branch=master)

# Apidaze PHP SDK

The Apidaze PHP SDK contains the PHP client of Apidaze REST API as well as an XML script builder.
The SDK allows you to leverage all Apidaze platform features such as making calls, sending text messages, serving IVR systems and many others in your PHP based application.
The SDK also includes sample applications that demonstrate how to use the SDK interfaces.
See [Apidaze REST API specification](https://apidocs.voipinnovations.com) which includes XML Scripting Reference as well.

# Requirements
- PHP 7.2/7.3/7.4

# Installation via Composer

To install requirements before using the SDK, just type

`composer install`

You're now ready to use the SDK

# Quickstart

## SDK client

### Initiate the SDK Client

```php
use Apidaze\Rest\Client as Apidaze;

$apidazeClient = new Apidaze("API_KEY", "API_SECRET");
```

Where `API_KEY` and `API_SECRET` should be replaced with the real key and secret from your Apidaze application.

### Make a call

```php
$apidazeClient->calls->place($assignedDID, $myNumber, $myNumber, CallType::number);
```

Where `$assignedDID` is the phone number to be presented as caller id and `$myNumber` the phone number or SIP account to ring first and passed as a parameter to your External Script URL.

### Send a text message

```php
$apidazeClient->messages->send("origin", "destination", "Hello World from PHP SDK");
```

Where `origin` is the number to send the text from. Must be an active number on your account.
`destination` is the number you want to send the text to.
The last argument is the message to send.

### Download recordings

```php
$filename = "my_recording.wav";
$response = $apidazeClient->recordings->get($filename);
\file_put_contents($filename, $response['body']);
```

In this example, we will download the recording named `my_recording.wav`.

## Script builder

The script builder is used to build XML instructions described in [XML Scripting Reference](https://apidocs.voipinnovations.com).
To build an instruction which echos back received audio to the caller with some delay use the following code.

```php
use Apidaze\Builder\Builder;
use Apidaze\Builder\Nodes\Answer;
use Apidaze\Builder\Nodes\EchoNode;
use Apidaze\Builder\Nodes\Speak;

$script = new Builder();
$speak = new Speak("Thank you for trying our demo. Have an wonderful day!");
$answer = new Answer();
$echoNode = new EchoNode(500);
$script->add($answer)->add($speak)->add($echoNode);

return $script->asXML();
```

The code above will produce the following XML

```xml
<?xml version='1.0' encoding='utf8'?>
<document>
  <work>
    <answer/>
    <speak lang="en-US">Thank you for trying our demo. Have an wonderful day!</speak>
    <echo>500</echo>
  </work>
</document>
```

## More examples

For more examples please see our [example repository](https://github.com/apidaze/sdk-php/tree/master/examples)
