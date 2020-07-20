<?php

use Apidaze\Builder\Nodes\BaseNode;
use Apidaze\Builder\Nodes\EchoNode;
use PHPUnit\Framework\TestCase;

class EchoNodeTest extends TestCase
{
    public function testEchoNode()
    {
        $expectedElement = '<echo>500</echo>';

        $node = new EchoNode(500);
        $got = $node->xmlToTest();

        $this->assertEquals($got, $expectedElement);
    }
}
