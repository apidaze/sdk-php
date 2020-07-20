<?php

use Apidaze\Builder\Nodes\BaseNode;
use Apidaze\Builder\Nodes\Number;
use PHPUnit\Framework\TestCase;

class NumberTest extends TestCase
{
    public function testNumber()
    {
        $expectedElement = '<number>1234567890</number>';

        $node = new Number("1234567890");
        $got = $node->xmlToTest();

        $this->assertEquals($got, $expectedElement);
    }
}
