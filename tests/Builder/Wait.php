<?php

use Apidaze\Builder\Nodes\BaseNode;
use Apidaze\Builder\Nodes\Wait;
use PHPUnit\Framework\TestCase;

class WaitTest extends TestCase
{
    public function testWait()
    {
        $expectedElement = '<wait>5</wait>';

        $node = new Wait(5);
        $got = $node->xmlToTest();

        $this->assertEquals($got, $expectedElement);
    }
}
