<?php

use Apidaze\Builder\Nodes\BaseNode;
use Apidaze\Builder\Nodes\Speak;
use PHPUnit\Framework\TestCase;

class SpeakTest extends TestCase
{
    public function testSpeak()
    {
        $expectedElement = '<speak lang="en-US">Hello</speak>';

        $node = new Speak("Hello");
        $got = $node->xmlToTest();

        $this->assertEquals($got, $expectedElement);
    }

    public function testSpeakDe()
    {
        $expectedElement = '<speak lang="de-DE">Hallo</speak>';

        $node = new Speak("Hallo", "de-DE");
        $got = $node->xmlToTest();

        $this->assertEquals($got, $expectedElement);
    }

    public function testSpeakPl()
    {
        $expectedElement = '<speak lang="pl-PL">Cześć</speak>';

        $node = new Speak("Cześć", "pl-PL");
        $got = $node->xmlToTest();

        $this->assertEquals($got, $expectedElement);
    }

    public function testSpeakInputTimeout()
    {
        $expectedElement = '<speak lang="en-US" input-timeout="60">Hello</speak>';

        $node = new Speak("Hello", "en-US", 60);
        $got = $node->xmlToTest();

        $this->assertEquals($got, $expectedElement);
    }

    public function testSpeakDigitTimeout()
    {
        $expectedElement = '<speak lang="en-US" input-timeout="60" digit-timeout="60">Hello</speak>';

        $node = new Speak("Hello", "en-US", 60, 60);
        $got = $node->xmlToTest();

        $this->assertEquals($got, $expectedElement);
    }
}
