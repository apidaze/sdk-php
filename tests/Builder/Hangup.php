<?php

use Apidaze\Builder\Nodes\BaseNode;
use Apidaze\Builder\Nodes\Hangup;
use PHPUnit\Framework\TestCase;

class HangupTest extends TestCase
{
    public function testHangup()
    {
        $expectedElement = '<hangup/>';

        $node = new Hangup();
        $got = $node->xmlToTest();

        $this->assertEquals($got, $expectedElement);
    }
}
