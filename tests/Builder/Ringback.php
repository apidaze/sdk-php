<?php

use Apidaze\Builder\Nodes\BaseNode;
use Apidaze\Builder\Nodes\Ringback;
use PHPUnit\Framework\TestCase;

class RingbackTest extends TestCase
{
    public function testRingback()
    {
        $expectedElement = '<ringback>http://ring.back</ringback>';

        $node = new Ringback("http://ring.back");
        $got = $node->xmlToTest();

        $this->assertEquals($got, $expectedElement);
    }
}
