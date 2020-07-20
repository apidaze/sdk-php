<?php

use Apidaze\Builder\Nodes\BaseNode;
use Apidaze\Builder\Nodes\Conference;
use PHPUnit\Framework\TestCase;

class ConferenceTest extends TestCase
{
    public function testConference()
    {
        $expectedElement = '<conference>my_room</conference>';

        $node = new Conference("my_room");
        $got = $node->xmlToTest();

        $this->assertEquals($got, $expectedElement);
    }
}
